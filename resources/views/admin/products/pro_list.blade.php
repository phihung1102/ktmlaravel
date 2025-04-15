@extends('admin.master')

@section('content')

    <div class="container_pro_l">
        <div class="title">
            <h1>Sản phẩm</h1>
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
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Giá gốc</th>
                    <th>Giá khuyến mãi</th>
                    <th>New</th>
                    <th>Top</th>
                    <th>Trạng thái</th>
                    <th>Nhà sản xuất</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset('images/' . $product->image) }}" style="width: 100px; height: 70px;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->sale_price}}</td>
                        <td>{{ $product->new}}</td>
                        <td>{{ $product->top}}</td>
                        <td>{{ $product->status}}</td>
                        <td>{{ $product->category_pro->name}}</td>
                        <td>
                            <a href="{{ route('getEditPro', $product->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('delPro', ['id'=>$product->id]) }}" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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