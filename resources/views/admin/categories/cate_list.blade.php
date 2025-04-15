@extends('admin.master')

@section('content')

    <div class="container_cate_l">
        <div class="title">
            <h1>Danh mục</h1>
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
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td style="max-width: 700px;">{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('getEditCate', $category->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('delCate', ['id'=>$category->id]) }}" onclick="return confirm('Bạn có chắc muốn xoá danh mục này không?')"><i class="fa-solid fa-trash"></i></a>
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