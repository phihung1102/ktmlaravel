@extends('admin.master')

@section('content')
    <div class="container_cate_e">
        <form action="{{ route('postEditCate', ['id' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="ctn_cate_e">
                <div class="title">
                    <h1>Danh mục</h1>
                    <h3>sửa</h3>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                </div>
                <div class="box">
                    <label>Tên danh mục:</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}">
                </div>
                <div class="box">
                    <label>Mô tả:</label>
                    <textarea name="description" id="description" cols="50" rows="20">{{ old('description', $category->description) }}</textarea>
                </div>
                <!-- Thông báo lỗi -->
                @if ($errors->any())
                    <div class="alert-danger" style="color: red; margin: 5px auto; font-size: 15px;">
                        <ul style="display: flex; flex-direction: column; gap: 5px; list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="btns">
                    <input type="submit" name="btnupdate" value="Sửa">
                    <input type="reset" name="btnreset" value="Đặt lại">
                </div>
            </div>
        </form>
    </div>
@endsection