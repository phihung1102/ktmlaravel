@extends('admin.master')

@section('content')
    <div class="container_cate">
        <form action="{{ route('postAddCate') }}" method="POST">
            @csrf
            <div class="ctn_cate">
                <div class="title">
                    <h1>Danh mục</h1>
                    <h3>thêm danh mục</h3>
                </div>
                <div class="box">
                    <label>Tên danh mục:</label>
                    <input type="text" name="name">
                </div>
                <div class="box">
                    <label>Mô tả:</label>
                    <input type="text" name="description">
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
                    <input type="submit" name="btnsubmit" value="Thêm">
                    <input type="reset" name="btnreset" value="Đặt lại">
                </div>
            </div>
        </form>
    </div>
@endsection