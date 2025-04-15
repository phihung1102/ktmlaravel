@extends('admin.master')

@section('content')
    <div class="container_pro">
        <form action="{{ route('postAddPro') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ctn_pro">
                <div class="title">
                    <h1>Sản phẩm</h1>
                    <h3>Thêm sản phẩm</h3>
                </div>
                <div class="box">
                    <label>Tên sản phẩm:</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="box">
                    <label>Mô tả:</label>
                    <input type="text" name="description" value="{{ old('description') }}">
                </div>
                <div class="box">
                    <label>Giá gốc:</label>
                    <input type="number" name="price" value="{{ old('price') }}">
                </div>
                <div class="box">
                    <label>Giá khuyến mãi:</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}">
                </div>
                <div class="box">
                    <label>Sản phẩm mới?</label>
                    <select name="new">
                        <option value="1">Có</option>
                        <option value="0" selected>Không</option>
                    </select>
                </div>
                <div class="box">
                    <label>Top sản phẩm?</label>
                    <select name="top">
                        <option value="1">Có</option>
                        <option value="0" selected>Không</option>
                    </select>
                </div>
                <div class="box">
                    <label>Trạng thái:</label>
                    <select name="status">
                        <option value="active" selected>Hiển thị</option>
                        <option value="inactive">Ẩn</option>
                    </select>
                </div>
                <div class="box">
                    <label>Danh mục:</label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="box">
                    <label>Hình ảnh:</label>
                    <input type="file" name="image" onchange="previewImage(event)"><br>
                </div>
                <img id="preview" style="margin-top: 10px; max-width: 200px; display: none;">

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
                    <input type="reset" name="btnreset" value="Đặt lại" onclick="resetPreview()">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function previewImage(){
            const input = event.target;
            const preview = document.getElementById('preview');

            if(input.files && input.files[0]){
                const reader = new FileReader();
                reader.onload = function(e){
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetPreview(){
            const preview = document.getElementById('preview');
            preview.src = '';
            preview.style.display = 'none';
        }
    </script>
@endsection
