@extends('admin.master')

@section('content')
    <div class="ctn_order_detail">
        <div class="title">
            <h1>Đơn hàng</h1>
            <h3>Chi tiết</h3>
        </div>

        <div class="ctn_od_dt">
            <div class="order_info">
                <label>Mã đơn hàng: <strong>#{{ $orders->first()->order->id }}</strong></label>
                <label>SĐT: <strong>{{ $orders->first()->order->user_od->phone }}</strong></label>
                <label>Họ tên: <strong>{{ $orders->first()->order->user_od->fullname }}</strong></label>
                <label>Email: <strong>{{ $orders->first()->order->user_od->email }}</strong></label>
                <label>Ngày đặt: <strong>{{ $orders->first()->order->date_order }}</strong></label>
                <label>Địa chỉ: <strong>{{ $orders->first()->order->shipping_address }}</strong></label>
            </div>

            <div class="product_list">
                @foreach ($orders as $item)
                    <div class="box">
                        <img src="{{ asset('images/' . $item->product_od->image) }}">
                        <div class="info">
                            <div class="name">
                                <label>{{ $item->product_od->category_pro->name }}</label>
                                <label>{{ $item->product_od->name }}</label>
                            </div>
                            <div class="pr_qtt">
                                <label class="pr">{{ $item->price }}$</label>
                                <label class="qtt">x{{ $item->quantity }}</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="total">
                <label>Tổng:</label>
                <label class="tt">{{ $orders->first()->order->total_amount }}$</label>
            </div>
            <div class="status">
                @php
                    $statusMap = [
                        'pending' => 'Chưa xử lý',
                        'processing' => 'Đã xử lý',
                        'shipped' => 'Đang giao hàng',
                        'completed' => 'Đã hoàn thành',
                        'cancelled' => 'Đã hủy',
                    ];
                @endphp
                <label>Trạng thái:</label>
                <label class="tt">{{ $statusMap[$orders->first()->order->status] ?? $orders->first()->order->status }}</label>
            </div>
        </div>
    </div>
@endsection
