@extends('layout.master')

@section('content')
    <div class="container_home">
        <div class="slideShow">
            <div class="slides fade">
                <img src="{{ asset('images/bn1.jpg') }}" alt="">
            </div>
            <div class="slides fade">
                <img src="{{ asset('images/bn2.jpg') }}" alt="">
            </div>
            <div class="slides fade">
                <img src="{{ asset('images/bn3.jpg') }}" alt="">
            </div>
            <div class="slides fade">
                <img src="{{ asset('images/bn4.jpg') }}" alt="">
            </div>
            <div class="slides fade">
                <img src="{{ asset('images/bn5.jpg') }}" alt="">
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div class="dots">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
            </div>
        </div>

        <div class="new_product">
            <h1>Sản phẩm mới</h1>
            <div class="ctn_new">
                @foreach($new_products as $new_product)
                    <div class="box">
                        <img src="{{ asset('images/' . $new_product->image) }}">
                        <label>{{ $new_product->category_pro->name }}</label>
                        <label>{{ $new_product->name }}</label>
                        <div class="prices">
                            @if($new_product->sale_price > 0)
                                <div class="sale_price">{{ $new_product->sale_price}}$</div>
                                <div class="price">{{ $new_product->price}}$</div>
                            @else
                                <div class="sale_price">{{ $new_product->price}}$</div>
                            @endif
                        </div>
                        <div class="btns">
                        <form action="{{ route('addToCart') }}" method="POST" class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $new_product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="price_at_time" value="{{ $new_product->sale_price > 0 ? $new_product->sale_price : $new_product->price }}">
                            <button type="submit"  class="addtocart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </form>
                            <a href="{{ route('getProDetails', ['id' => $new_product->id]) }}" class="details">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="top_product">
            <h1>Sản phẩm nổi bật</h1>
            <div class="ctn_top">
                @foreach($top_products as $top_product)
                    <div class="box">
                        <img src="{{ asset('images/' . $top_product->image) }}">
                        <label>{{ $top_product->category_pro->name }}</label>
                        <label>{{ $top_product->name }}</label>
                        <div class="prices">
                            @if($top_product->sale_price > 0)
                                <div class="sale_price">{{ $top_product->sale_price}}$</div>
                                <div class="price">{{ $top_product->price}}$</div>
                            @else
                                <div class="sale_price">{{ $top_product->price}}$</div>
                            @endif
                        </div>
                        <div class="btns">
                            <form action="{{ route('addToCart') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $top_product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="price_at_time" value="{{ $top_product->sale_price > 0 ? $top_product->sale_price : $top_product->price }}">
                                <button type="submit" class="addtocart">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </form>
                            <a href="{{ route('getProDetails', ['id' => $top_product->id]) }}" class="details">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sale_product">
            <h1>Khuyến mãi</h1>
            <div class="ctn_sale">
                @foreach($sale_products as $sale_product)
                    <div class="box">
                        <img src="{{ asset('images/' . $sale_product->image) }}">
                        <label>{{ $sale_product->category_pro->name }}</label>
                        <label>{{ $sale_product->name }}</label>
                        <div class="prices">
                            @if($sale_product->sale_price > 0)
                                <div class="sale_price">{{ $sale_product->sale_price}}$</div>
                                <div class="price">{{ $sale_product->price}}$</div>
                            @else
                                <div class="sale_price">{{ $sale_product->price}}$</div>
                            @endif
                        </div>
                        <div class="btns">
                            <form action="{{ route('addToCart') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $sale_product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="price_at_time" value="{{ $sale_product->sale_price > 0 ? $sale_product->sale_price : $sale_product->price }}">
                                <button type="submit" class="addtocart">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </form>
                            <a href="{{ route('getProDetails', ['id' => $sale_product->id]) }}" class="details">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n){
                showSlides(slideIndex += n);
            }

            function currentSlide(n){
                showSlides(slideIndex = n);
            }

            function showSlides(n){
                let i;
                let slides = document.getElementsByClassName("slides");
                let dots = document.getElementsByClassName("dot");
                if(n > slides.length){ slideIndex = 1 }
                if(n < 1){ slideIndex = slides.length }
                for(i = 0; i < slides.length; i++){
                    slides[i].style.display = "none";
                }
                for(i = 0; i < dots.length; i++){
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }

            setInterval(() => {
                plusSlides(1);
            }, 4000);

        });
    </script>
@endsection
