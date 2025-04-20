@extends('layout.master')

@section('content')
    <div class="container_acc">
        <div class="profile">
            <form action="{{ route('updateProfile') }}" method="POST">
                @csrf
                <label class="title">Thông tin cá nhân</label>
                <div class="item">
                    <label>Tên tài khoản:</label>
                    <input type="text" name="username" value="{{ $user->username }}">
                </div>
                <div class="item">
                    <label>Tên đầy đủ:</label>
                    <input type="text" name="fullname" value="{{ $user->fullname }}">
                </div>
                <div class="item">
                    <label>Số điện thoại:</label>
                    <input type="text" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="item">
                    <label>Địa chỉ:</label>
                    <textarea name="address" cols="4" rows="2">{{ $user->address }}</textarea>
                </div>
                <div class="item">
                    <label>Giới tính:</label>
                    <select name="gender">
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
                <div class="item">
                    <label>Ngày sinh:</label>
                    <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}">
                </div>
                <div class="item">
                    <label>Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}">
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
                <input type="submit" name="btnsave" value="Lưu">
            </form>
        </div>
        <div class="orders">
            <label class="title">Đơn hàng của tôi</label>
            <div class="ctn_myOrders">
                @php
                    $statusMap = [
                        'pending' => 'Chưa xử lý',
                        'processing' => 'Đang xử lý',
                        'shipped' => 'Đang giao hàng',
                        'completed' => 'Đã hoàn thành',
                        'cancelled' => 'Đã hủy',
                    ];
                @endphp
                @foreach ($orders as $order)
                    <div class="box">
                        <div class="order_item">
                            <h3>Đơn hàng #{{ $order->id }} - Ngày đặt: {{ $order->created_at->format('d/m/Y')}}</h3>
                            @foreach($order->order_items as $item)
                                <div class="order_item_b">
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
                            <label class="tt">{{ $order->total_amount }}$</label>
                        </div>
                        <div class="btn">
                            <label class="status">Trạng thái: {{ $statusMap[$order->status] ?? $order->status }}</label>
                            @if(in_array($order->status, ['pending', 'processing']))
                                <form action="{{ route('cancelOrder', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-cancel">Hủy đơn</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        setTimeout(() => {
            var success = document.getElementById('success');
            var error = document.getElementById('error');
            if(success) success.style.display = 'none';
            if(error) error.style.display = 'none';
        }, 4000);
    </script>
@endsection