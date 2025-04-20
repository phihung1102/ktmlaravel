@extends('admin.master')

@section('content')
    @php
        use App\Http\Controllers\OrderController;
    @endphp
    <div class="container_slide">
        <div class="title">
            <h1>Slide</h1>
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
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Link</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slides as $slide)
                <tr>
                    <td><img src="{{ asset('images/' . $slide->image) }}" width="100"></td>
                    <td>{{ $slide->title }}</td>
                    <td>{{ $slide->description }}</td>
                    <td>{{ $slide->link }}</td>
                    <td>{{ $slide->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('admin.slides.edit', $slide->id) }}">Sửa</a>
                        <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
