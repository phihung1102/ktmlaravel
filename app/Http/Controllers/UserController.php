<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order_Item;
use App\Models\Order;

class UserController extends Controller
{
    public function getListUser(){
        $users = User::where('role', '!=', 1)->orderBy('id', 'desc')->get();
        return view('admin.users.user_list', compact('users'));
    }

    public function getEditUser($id){
        $user = User::findOrFail($id);
        return view('admin.users.user_edit', compact('user'));
    }

    public function postEditUser(Request $req, $id){
        $validated = $req->validate([
            'role'=>'required|integer',
        ],[
            'role.required'=>'Vui lòng chọn vai trò!',
        ]);
        $user = User::findOrFail($id);
        $user->role = $req->role;
        $user->save();
        return redirect()->route('getListUser')->with('success', 'Sửa thành công!');
    }

    public function delUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('getListUser')->with('success', 'Xoá thành công');
    }

    public function getProfile(){
        $user = Auth::user();
        $orders = Order::with('order_items.product_od.category_pro')
                        ->where('user_id', $user->id)
                        ->whereNotIn('status', ['completed', 'cancelled'])
                        ->get();
        return view('pages.account', compact('user', 'orders'));
    }
    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn hàng khi đang chờ xử lý hoặc đang xử lý!');
        }
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công!');
    }


    public function updateProfile(Request $req){
        $user = Auth::user();

        $validated = $req->validate([
            'username' => 'required|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other,Nam,Nữ,Khác',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->username = $req->username;
        $user->fullname = $req->fullname;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->gender = $req->gender;
        $user->date_of_birth = $req->date_of_birth;
        $user->email = $req->email;
        $user->save();
        return redirect()->route('getProfile')->with('success', 'Lưu thông tin thành công!');
    }
}
