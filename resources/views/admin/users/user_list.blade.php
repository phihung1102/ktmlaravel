@extends('admin.master')

@section('content')

    <div class="container_user_l">
        <div class="title">
            <h1>Người dùng</h1>
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
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Tên đầy đủ</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Vai trò</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->address}}</td>
                        <td>{{ $user->gender}}</td>
                        <td>{{ $user->date_of_birth}}</td>
                        <td>{{ $user->role}}</td>
                        <td>
                            <a href="{{ route('getEditUser', $user->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('delUser', ['id'=>$user->id]) }}" onclick="return confirm('Bạn có chắc muốn xoá người dùng này không?')"><i class="fa-solid fa-trash"></i></a>
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