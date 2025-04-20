@extends('admin.master')

@section('content')
    <div class="container_pro_e">
        <form action="{{ route('postEditPro', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="ctn_pro_e">
                <div class="title">
                    <h1>Danh mục</h1>
                    <h3>sửa</h3>
                </div>

                <div class="form-grid">
                    <div class="box">
                        <label>Tên danh mục:</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}">
                    </div>
                    <div class="box">
                        <label>Mô tả:</label>
                        <textarea name="description">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="box">
                        <label>Giá gốc:</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}">
                    </div>
                    <div class="box">
                        <label>Giá khuyến mãi:</label>
                        <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                    </div>
                    <div class="box">
                        <label>Sản phẩm mới?</label>
                        <select name="new">
                            <option value="1" {{ old('new', $product->new) == 1 ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ old('new', $product->new) == 0 ? 'selected' : '' }}>Không</option>
                        </select>
                    </div>
                    <div class="box">
                        <label>Top sản phẩm?</label>
                        <select name="top">
                            <option value="1" {{ old('top', $product->top) == 1 ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ old('top', $product->top) == 0 ? 'selected' : '' }}>Không</option>
                        </select>
                    </div>
                    <div class="box">
                        <label>Trạng thái:</label>
                        <select name="status">
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    <div class="box">
                        <label>Danh mục:</label>
                        <select name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="box">
                    <label>Hình ảnh cũ:</label>
                    <div class="img-preview">
                        <img src="{{ asset('images/' . $product->image) }}" alt="Hình ảnh cũ">
                    </div>
                </div>
                <div class="box">
                    <label>Hình ảnh mới:</label>
                    <input type="file" name="image" onchange="previewImage(event)">
                    <img id="preview" style="margin-top: 10px; max-width: 200px; display: none;">
                </div>

                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="btns">
                    <input type="submit" name="btnupdate" value="Sửa">
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