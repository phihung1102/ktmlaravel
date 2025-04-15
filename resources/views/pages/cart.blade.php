@extends('layout.master')

@section('content')
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
    <div class="container_cart">
        <label class="cartTitle">Giỏ hàng</label>
        <form id="orderForm" action="{{ route('showOrder') }}" method="POST">
            @csrf
            <div class="ctncart">
                @foreach($cartItems as $cartItem)
                    <div class="box">
                        <input type="checkbox" class="checkbox" name="selected_items[]" value="{{ $cartItem->id }}" checked>
                        <img src="{{ asset('images/' . $cartItem->product->image) }}">
                        <div class="title">
                            <label class="mf">{{ $cartItem->product->category_pro->name }}</label>
                            <label class="name">{{ $cartItem->product->name }}</label>
                        </div>
                        <div class="price">{{ $cartItem->price_at_time }}$</div>
                        <div class="quantity">
                            <div class="qtt_control">
                                <button type="button" onclick="decrease(this)"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" id="quantity" name="quantity[{{ $cartItem->id }}]" value="{{ $cartItem->quantity }}" min="1">
                                <button type="button" onclick="increase(this)"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <a href="{{ route('delCart', ['id'=>$cartItem->id]) }}" class="delCartItem" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')"><i class="fa-solid fa-trash"></i></a>
                    </div>
                @endforeach
            </div>
            <div class="order">
                <div id="totalPrice" class="total-price">Tổng tiền: 0$</div>
                <button type="submit" class="btnorder">Đặt hàng</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function increase(button){
            let input = button.parentElement.querySelector('input');
            input.value = parseInt(input.value) + 1;
            if(button.closest('.box').querySelector('.ckeckbox').checked){
                calculateTotal();
            }
        }
        function decrease(button){
            let input = button.parentElement.querySelector('input');
            if(parseInt(input.value) > 1){
                input.value = parseInt(input.value) - 1;
                if(button.closest('.box').querySelector('.ckeckbox').checked){
                    calculateTotal();
                }
            }
        }
        setTimeout(() => {
            var success = document.getElementById('success');
            var error = document.getElementById('error');
            if(success) success.style.display = 'none';
            if(error) error.style.display = 'none';
        }, 4000);

        function calculateTotal(){
            let total = 0;
            const checkboxes = document.querySelectorAll('.checkbox:checked');
            checkboxes.forEach(checkbox => {
                const box = checkbox.closest('.box');
                const price = parseFloat(box.querySelector('.price').textContent);
                const quantity = parseInt(box.querySelector('input[name^="quantity"]').value);
                total += price * quantity;
            });
            document.getElementById('totalPrice').textContent = `Tổng tiền: ${total.toFixed(2)}$`;
        }

        document.querySelectorAll('.checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function(){
                calculateTotal()
            });
        });

        document.addEventListener('DOMContentLoaded', calculateTotal());
    </script>
@endsection