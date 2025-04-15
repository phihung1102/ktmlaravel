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
                    <label>Tên tài khoản:</label>
                    <input type="text" name="name" value="{{ old('username', $user->username) }}">
                </div>
                <div class="box">
                    <label>Vai trò:</label>
                    <select name="role">
                        <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Kỹ thuật viên</option>
                        <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Khách hàng</option>
                    </select>
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