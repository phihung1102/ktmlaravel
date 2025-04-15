@extends('layout.master')
@section('content')
        <div class="container_register">
            <form action="{{ route('postSignup') }}" method="POST">
                @csrf
                <div class="box">
                    <h1>Đăng ký</h1>
                    <div class="item">
                        <label>Tên tài khoản:</label>
                        <input type="text" name="username" >
                    </div>
                    <div class="item">
                        <label>Email:</label>
                        <input type="text" name="email" >
                    </div>
                    <div class="item">
                        <label>Mật khẩu:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="item">
                        <label>Xác nhận mật khẩu:</label>
                        <input type="password" name="re_password" id="re_password">
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

                    @if (session('success'))
                        <div class="alert-success" style="width: 100%; color: green; margin: 5px auto; font-size: 15px; text-align: center">
                            {{session('success')}}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert-error" style="color: green; margin: 5px auto; font-size: 15px;">
                            {{session('error')}}
                        </div>
                    @endif

                    <input type="submit" name="btnregister" value="Đăng ký">

                    <div class="have_acount">
                        <label>Bạn đã có tài khoản?</label>
                        <a href="{{ route('login') }}">Đăng nhập</a>
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
            const re_pass = document.getElementById('re_password');

            checkbox.addEventListener("change", function(){
                const type = this.checked ? "text" : "password";
                pass.type = type;
                re_pass.type = type;
            });
        });
    </script>
@endsection

