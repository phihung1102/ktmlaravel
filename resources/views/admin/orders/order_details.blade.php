@extends('admin.master')

@section('content')
    <div class="ctn_order_detail">
        <div class="title">
            <h1>Đơn hàng</h1>
            <h3>chi tiết</h3>
        </div>
        <div class="ctn_od_dt">
            <label>Mã đơn hàng: #{{ $orders->first()->order->id }}</label>
            <label>{{ $orders->first()->order->user_od->phone }}</label>
            <label>Họ tên: {{ $orders->first()->order->user_od->fullname }}</label>
            <label>Email: {{ $orders->first()->order->user_od->email }}</label>
            <label>Ngày đặt: {{ $orders->first()->order->date_order }}</label>
            <label>Địa chỉ: {{ $orders->first()->order->shipping_address }}</label>
            @php
                $statusMap = [
                    'pending' => 'Chưa xử lý',
                    'processing' => 'Đang xử lý',
                    'shipping' => 'Đang giao hàng',
                    'completed' => 'Đã hoàn thành',
                    'cancelled' => 'Đã hủy',
                ];
            @endphp
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
            <div class="total">
                <label>Tổng:</label>
                <label class="tt">{{ $orders->first()->order->total_amount }}$</label>
            </div>
            <form action="{{ route('admin.orders.updateStatus', $orders->first()->order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Cập nhật trạng thái:</label>
                    <select name="status" id="status">
                        @foreach ($statusMap as $key => $label)
                            <option value="{{ $key }}" {{ $orders->first()->order->status === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection