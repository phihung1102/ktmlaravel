<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function getIndex(){
        $slides = Slide::where('status', 1)->get();
        $new_products = Product::with('category_pro')->where('new', 1)->get();
        $top_products = Product::with('category_pro')->where('top', 1)->get();
        $sale_products = Product::with('category_pro')->where('sale_price', '<>', 0)->get();
        return view('pages.home', compact('new_products', 'top_products', 'sale_products', 'slides'));
    }

    public function getSignup(){
        return view('pages.register');
    }
    public function postSignup(Request $req){
        $validated = $req->validate([
            'email'=>'required|email|unique:users,email',
            'username'=>'required|unique:users,username',
            'password'=>'required|min:6|max:20',
            're_password'=>'required|same:password',
        ],[
            'username.required'=>'Vui lòng nhập username',
            'username.unique'=>'Tên người dùng đã tồn tại',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử  dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự',
            're_password.same'=>'Mật khẩu không giống nhau',
            're_password.required'=>'Vui lòng xác nhận mật khẩu',
        ]);
        $user=new User();
        $user->username=$req->username;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->role=3;
        if ($user->save()) {
            return redirect()->back()->with('success', 'Tạo tài khoản thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(Request $req){
        $validated = $req->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:20',
        ],[
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự',
        ]);
        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            if (Auth::user()->role == 1) {
                return redirect()->route('getListCate')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
            } else {
                return redirect('/trangchu')->with(['flag' => 'warning', 'message' => 'Đăng nhập thành công']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Sai tài khoản hoặc mật khẩu']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('trangchu');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $category_id = $request->input('category_id');

        $query = Product::query();

        if ($keyword) {
            $query->where('name', 'like', "%$keyword%");
        }

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('pages.search_result', [
            'products' => $products,
            'keyword' => $keyword ?? '',
            'categories' => $categories
        ]);
    }

    // public function getContact(){
    //     return view();
    // }


}
