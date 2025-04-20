@extends('admin.master')

@section('content')
<div class="container_slide_create">
    <h2>Thêm Slide Mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="left-column">
                <div>
                    <label>Tiêu đề:</label>
                    <input type="text" name="title" value="{{ old('title') }}">
                </div>

                <div>
                    <label>Link:</label>
                    <input type="text" name="link" value="{{ old('link') }}">
                </div>

                <div>
                    <label>Hiển thị:</label>
                    <input type="checkbox" name="status" checked>
                </div>
            </div>

            <div class="right-column">
                <div>
                    <label>Mô tả:</label>
                    <textarea name="description">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label>Hình ảnh:</label>
                    <input type="file" name="image" id="imageInput" accept="image/*" required>
                    <div id="previewContainer"></div>
                </div>
            </div>
        </div>

        <div class="submit-wrap">
            <button type="submit">Thêm mới</button>
        </div>
    </form>
</div>

@endsection


@section('js')
<script>
    document.getElementById('imageInput').addEventListener('change', function (event) {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = ''; // Clear previous preview

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.width = 200;
                previewContainer.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
