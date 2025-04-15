@extends('admin.master')

@section('content')
    <div class="container_order_com">
    <div class="title">
            <h1>Đơn hàng</h1>
            <h3>danh sách</h3>
        </div>
        @if (session('success'))
            <div id="success" class="alert-success" style="width: 100%; color: green; margin: 5px auto; font-size: 15px; text-align: center">
                {{session('success')}}
            </div>
        @endif
        
        @if (session('error'))
            <div id="error" class="alert-error" style="color: green; margin: 5px auto; font-size: 15px;">
                {{session('error')}}
            </div>
        @endif
        @php
            $statusMap = [
                'pending' => 'Chưa xử lý',
                'processing' => 'Đang xử lý',
                'shipping' => 'Đang giao hàng',
                'completed' => 'Đã hoàn thành',
                'cancelled' => 'Đã hủy',
            ];
        @endphp
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Hành động</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->date_order }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->shipping_address }}</td>
                        <td>{{ $statusMap[$order->status] ?? $order->status }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>
                            <a href="{{ route('getOrderDetails', ['id'=>$order->id]) }}">Xem chi tiết</a>
                        </td>
                        <td>
                            <a href="{{ route('delOrder', ['id'=>$order->id]) }}" onclick="return confirm('Bạn có chắc muốn xoá danh mục này không?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection