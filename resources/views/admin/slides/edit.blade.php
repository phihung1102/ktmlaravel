@extends('admin.master')

@section('content')
<div class="container_slide_edit">
    <h2>Sửa Slide</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-item">
                <label>Tiêu đề:</label>
                <input type="text" name="title" value="{{ old('title', $slide->title) }}">
            </div>

            <div class="form-item">
                <label>Mô tả:</label>
                <textarea name="description">{{ old('description', $slide->description) }}</textarea>
            </div>

            <div class="form-item">
                <label>Link:</label>
                <input type="text" name="link" value="{{ old('link', $slide->link) }}">
            </div>

            <div class="form-item">
                <label>Hình ảnh hiện tại:</label><br>
                <img src="{{ asset('images/' . $slide->image) }}" width="200"><br><br>

                <label>Thay ảnh mới:</label>
                <input type="file" name="image" id="imageInput" accept="image/*" multiple><br><br>

                <div id="previewContainer" style="display: flex; gap: 10px;"></div>
            </div>

            <div class="form-item">
                <label>Hiển thị:</label>
                <input type="checkbox" name="status" {{ $slide->status ? 'checked' : '' }}>
            </div>

            <div class="form-item">
                <button type="submit">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    document.querySelector('input[type="file"]').addEventListener('change', function (e) {
        if (this.files.length > 1) {
            alert('Chỉ được chọn 1 ảnh!');
            this.value = '';
        }
    });
</script>
@endsection
