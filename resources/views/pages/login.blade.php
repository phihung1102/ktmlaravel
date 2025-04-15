@extends('layout.master')

@section('content')

        <div class="container_login">
            <form action="{{ route('postSignin') }}" method="POST">
                @csrf
            
                <div class="box">
                    <h1>Đăng nhập</h1>
                    <div class="item">
                        <label>Email:</label>
                        <input type="text" name="email">
                    </div>
                    <div class="item">
                        <label>Mật khẩu:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="showpass">
                        <input type="checkbox" id="showPass">Hiển thị mật khẩu
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

                    <input type="submit" name="btnlogin" value="Đăng nhập">

                    <div class="have_acount">
                        <label>Bạn chưa có tài khoản?</label>
                        <a href="{{ route('register') }}">Đăng ký</a>
                    </div>
                </div>
            </form>
        </div>

@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            const checkbox = document.getElementById('showPass');
            const pass = document.getElementById('password');

            checkbox.addEventListener("change", function(){
                const type = this.checked ? "text" : "password";
                pass.type = type;
            });
        });
    </script>
@endsection