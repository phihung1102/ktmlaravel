@extends('layout.master')

@section('content')
    <div class="search-results">
        <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>

        @if($products->isEmpty())
            <p>Không tìm thấy sản phẩm nào.</p>
        @else
            <div class="product-list">
                @foreach ($products as $product)
                    <div class="product-item">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="title">
                            <label>{{ $product->category_pro->name }}</label>
                            <label>{{ $product->name }}</label>
                        </div>
                        <p>Giá: {{ $product->price }}$</p>
                        <div class="btn"><a href="{{ route('getProDetails', ['id' => $product->id]) }}">Xem chi tiết</a></div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
