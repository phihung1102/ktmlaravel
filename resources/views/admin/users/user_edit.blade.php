@extends('admin.master')

@section('content')
    <div class="container_user_e">
        <form action="{{ route('postEditUser', ['id'=>$user->id] ) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="ctn_user_e">
                <div class="title">
                    <h1>Người dùng</h1>
                    <h3>sửa</h3>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                </div>
                <div class="box">
                    <label for="username">Tên tài khoản:</label>
                    <input type="text" id="username" name="name" value="{{ old('username', $user->username) }}" placeholder="Nhập tên tài khoản">
                </div>
                <div class="box">
                    <label for="role">Vai trò:</label>
                    <select id="role" name="role">
                        <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Kỹ thuật viên</option>
                        <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Khách hàng</option>
                    </select>
                </div>

                <!-- Thông báo lỗi -->
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
                    <button type="submit" class="btn-update">Sửa</button>
                    <button type="reset" class="btn-reset">Đặt lại</button>
                </div>
            </div>
        </form>
    </div>
@endsection
