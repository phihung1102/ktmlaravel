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
    <div class="container_details">
        <div class="ctn_details"> 
            <div class="box">
                <img src="{{ asset('images/' . $product->image) }}">
                <div class="infor">
                    <div class="title">
                        <label>{{ $product->category_pro->name }}</label>
                        <label>{{ $product->name }}</label>
                    </div>

                    @if($product->sale_price > 0)
                        <div class="prices"><label>Giá gốc:</label><div class="price">{{ $product->price }}$</div></div>
                        <div class="prices"><label>Giá khuyến mãi:</label><div class="sale_price">{{ $product->sale_price }}$</div></div>
                    @else
                        <div class="prices"><label>Giá gốc:</label><div class="sale_price">{{ $product->price }}$</div></div>
                    @endif
                    
                    <div>
                        <form action="{{ route('addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="price_at_time" value="{{$product->sale_price > 0 ? $product->sale_price : $product->price}}">
                            <div class="quantity">
                                <label>Số lượng:</label>
                                <div class="qtt_control">
                                    <button type="button" onclick="decrease()"><i class="fa-solid fa-minus"></i></button>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                                    <button type="button" onclick="increase()"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                            <button type="submit" class="btnAddToCart"><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                    <div class="description">Mô tả:<label>{{ $product->description }}</label></div>
                </div>
            </div>
            <div class="Mf">Nhà sản xuất:<label>{{ $product->category_pro->description }}</label></div>
        </div>
        <div class="related_products">
            <h1>Sản phẩm liên quan</h1>
            <div class="list">
                @if($related_products->count())
                    @foreach($related_products as $related_product)
                        <div class="box">
                            <img src="{{ asset('images/' . $related_product->image) }}">
                            <a href="{{ route('getProDetails', ['id' => $related_product->id]) }}">Xem</a>
                        </div>
                    @endforeach
                @else
                    <label>Không có sản phẩm liên quan</label>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function increase(){
            let qtyInput = document.getElementById('quantity');
            qtyInput.value = parseInt(qtyInput.value) + 1;
        }
        function decrease(){
            let qtyInput = document.getElementById('quantity');
            if(parseInt(qtyInput.value) > 1){
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        }
        setTimeout(() => {
            var success = document.getElementById('success');
            var error = document.getElementById('error');
            if(success) success.style.display = 'none';
            if(error) error.style.display = 'none';
        }, 4000);
    </script>
@endsection