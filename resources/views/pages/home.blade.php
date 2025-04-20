@extends('layout.master')

@section('content')
    <div class="slideShow">
        @foreach($slides as $index => $slide)
            <div class="slides fade">
                <img src="{{ asset('images/' . $slide->image) }}" alt="">
            </div>
        @endforeach

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

        <div class="dots">
            @foreach($slides as $index => $slide)
                <span class="dot" onclick="currentSlide({{ $index + 1 }})"></span>
            @endforeach
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
                        @php
                            $isFavorite = auth()->check() && $new_product->favoritedBy->contains('user_id', auth()->id());
                        @endphp

                        <button class="favorite-btn" data-product-id="{{ $new_product->id }}">
                            <i class="fa-heart fa-solid {{ $isFavorite ? 'active' : 'fa-regular' }}"></i>
                        </button>
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
                        @php
                        $isFavorite = auth()->check() && $top_product->favoritedBy->contains('user_id', auth()->id());
                    @endphp

                    <button class="favorite-btn" data-product-id="{{ $top_product->id }}">
                        <i class="fa-heart fa-solid {{ $isFavorite ? 'active' : 'fa-regular' }}"></i>
                    </button>
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
                        @php
                            $isFavorite = auth()->check() && $sale_product->favoritedBy->contains('user_id', auth()->id());
                        @endphp

                        <button class="favorite-btn" data-product-id="{{ $sale_product->id }}">
                            <i class="fa-heart fa-solid {{ $isFavorite ? 'active' : 'fa-regular' }}"></i>
                        </button>
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

        window.plusSlides = function(n) {
            showSlides(slideIndex += n);
        }

        window.currentSlide = function(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        setInterval(() => {
            plusSlides(1);
        }, 4000);
    });

    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const icon = this.querySelector('.fa-heart');

            fetch("{{ route('toggleFavorite') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('active', 'fa-solid');
                } else {
                    icon.classList.remove('active', 'fa-solid');
                    icon.classList.add('fa-regular');
                }
            });
        });
    });
</script>
@endsection

