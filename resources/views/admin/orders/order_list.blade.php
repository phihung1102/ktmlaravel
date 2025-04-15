@extends('admin.master')

@section('content')
    <div class="container_order_l">
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
                    <th>Trạng thái thanh toán</th>
                    <th>Hành động</th>
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
                        <td>
                            <select class="order-status" data-order-id="{{ $order->id }}">
                                @foreach ($statusMap as $key => $label)
                                    <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>
                            <a href="{{ route('getOrderDetails', ['id'=>$order->id]) }}">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.order-status').change(function () {
                var orderId = $(this).data('order-id');
                var status = $(this).val();

                $.ajax({
                    url: "{{ route('updateStatusOd') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId,
                        status: status
                    },
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('');
                    }
                });
            });
        });
    </script>

@endsection