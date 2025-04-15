@extends('layout.master')

@section('content')
    <div class="container_order">
        <label class="title">Xác nhận đơn hàng</label>
        <form action="{{ route('postOrder') }}" method="POST">
            @csrf
            <div class="ctn">
                <div class="ctn_order">
                    @foreach ($selectedItems as $item)
                        <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
                        <input type="hidden" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}">
                        <div class="item_order">
                            <img src="{{ asset('images/' . $item->product->image) }}">
                            <div class="od_infor">
                                <div class="name">{{ $item->product->category_pro->name }} {{ $item->product->name }} </div>
                                <div class="qtt_pr">
                                    <div class="pr">Giá: {{ $item->price_at_time }}$</div>
                                    <div class="qtt">x{{ $item->quantity }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="total">
                        <label>Tổng: </label>
                        <div class="tt">{{ $total }}$</div>
                    </div>
                </div>
                <div class="ctn_order_infor">
                    <div class="item">
                        <label>Số điện thoại:</label>
                        <input type="text" name="phone" value="{{ $item->cart->user->phone }}">
                    </div>
                    <div class="item">
                        <label>Tên:</label>
                        <input type="text" name="fullname" value="{{ $item->cart->user->fullname }}">
                    </div>
                    <div class="item">
                        <label>Địa chỉ:</label>
                        <textarea name="shipping_address" cols="10" rows="2">{{ $item->cart->user->address }}</textarea>
                    </div>
                    <div class="item">
                        <label>Phương thức thanh thoá:</label>
                        <select name="payment_method">
                            <option value="COD">COD</option>
                            <option value="Momo">Momo</option>
                            <option value="Bank_transfer">Bank_transfer</option>
                        </select>
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
                    <input type="submit" name="btnorder" value="Đặt hàng">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')

@endsection