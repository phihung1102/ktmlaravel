<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_Item;
use App\Models\Order_Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdated;

class OrderController extends Controller
{
    public function showOrder(Request $req){
        $selectedIds = $req->input('selected_items');
        $quantities = $req->input('quantity');
        $selectedItems = Cart_Item::with('product.category_pro', 'cart.user')->whereIn('id', $selectedIds)->get();
        $total = 0;
        foreach($selectedItems as $item){
            if(isset($quantities[$item->id])){
                $item->quantity = $quantities[$item->id];
                $total += $item->quantity * $item->price_at_time;
            }
        }

        return view('pages.order', compact('selectedItems', 'total'));
    }

    public function postOrder(Request $req) {
        $selectedIds = $req->input('selected_items');
        $quantities = $req->input('quantity');
        $selectedItems = Cart_Item::with('product', 'cart.user')->whereIn('id', $selectedIds)->get();
    
        if ($selectedItems->isEmpty()) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được chọn!');
        }
    
        $user = $selectedItems->first()->cart->user;
    
        if (empty($user->address)) {
            $user->address = $req->input('shipping_address');
            $user->save();
        }
    
        $total = 0;
        foreach ($selectedItems as $item) {
            if (isset($quantities[$item->id])) {
                $item->quantity = $quantities[$item->id];
                $total += $item->quantity * $item->price_at_time;
            }
        }
    
        DB::beginTransaction();
    
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'date_order' => Carbon::now(),
                'total_amount' => $total,
                'shipping_address' => $req->input('shipping_address'),
                'status' => 'pending',
                'payment_method' => $req->input('payment_method'),
                'payment_status' => 'unpaid',
            ]);
    
            foreach($selectedItems as $item) {
                Order_Item::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price_at_time,
                ]);
            }
    
            // Gửi email thông báo đặt hàng thành công
            Mail::to('phihung11022005@gmail.com')->send(new OrderPlaced($order, $user));
    
            Cart_Item::whereIn('id', $selectedIds)->delete();
    
            DB::commit();
            return redirect()->route('getProfile')->with('success', 'Đặt hàng thành công! Kiểm tra email để xem chi tiết.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng: ' . $e->getMessage());
        }
    }
    
    
    public function getOrderList(){
        $orders = Order::whereIn('status', ['processing'])->get();
        return view('admin.orders.order_list', compact('orders'));
    }

    public function getOrderListCompleted(){
        $orders = Order::whereIn('status', ['completed'])->get();
        return view('admin.orders.order_completed', compact('orders'));
    }

    public function getOrderListCancelled(){
        $orders = Order::whereIn('status', ['cancelled'])->get();
        return view('admin.orders.order_cancelled', compact('orders'));
    }

    public function getOrderListShipped(){
        $orders = Order::whereIn('status', ['shipped'])->get();
        return view('admin.orders.order_shipping', compact('orders'));
    }

    public function getOrderListPending(){
        $orders = Order::whereIn('status', ['pending'])->get();
        return view('admin.orders.order_pending', compact('orders'));
    }

    public function getOrderDetails($id){
        $orders = Order_Item::with(['order.user_od','product_od.category_pro'])->where('order_id', $id)->get();
        return view('admin.orders.order_details', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order = Order::with('user_od')->findOrFail($id); // Load user
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        try {
            if ($order->user_od && $order->user_od->email) {
                Mail::to($order->user_od->email)
                    ->send(new OrderStatusUpdated($order, $oldStatus));
            }

            return redirect()->back()->with('success', 'Cập nhật trạng thái và gửi email thành công!');
        } catch (\Exception $e) {
            \Log::error('Lỗi gửi email: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Cập nhật trạng thái thành công nhưng gửi email thất bại!');
        }
    }


    public function delOrder($id){
        Order_Item::where('order_id', $id)->delete();
        Order::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
    }

    public function updateStatus(Request $req)
    {   
        $req->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);
        $order = Order::with('user_od')->findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $req->status;
        $order->save();

        $validStatuses = $this->getAvailableStatusOptions($order->status);
        $newStatus = $request->input('status');
        if (!in_array($newStatus, $validStatuses)) {
            return response()->json(['success' => false, 'message' => 'Trạng thái không hợp lệ!']);
        }
        if ($order->user) {
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order, $oldStatus));
        }

        $order->status = $newStatus;
        $order->save();

        return redirect()->route('getOrderList')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public static function getAvailableStatusStatic($currentStatus)
    {
        $transitions = [
            'pending' => ['pending', 'processing', 'cancelled'],
            'processing' => ['processing', 'shipped', 'cancelled'],
            'shipped' => ['shipped', 'completed', 'cancelled'],
            'completed' => ['completed'],
            'cancelled' => ['cancelled','pending', 'processing', 'shipped'],
        ];
        return $transitions[$currentStatus] ?? [];
    }

    public static function getStatusVietnamese($status)
    {
        $statusMap = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đang giao hàng',
            'completed' => 'Đã hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        
        return $statusMap[$status] ?? $status;
    }
}
