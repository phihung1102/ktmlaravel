

    <Header class="container_header">
        <div class="container_h_h">
            <div class="hotline">Hotline: 0817423628</div>
            <div class="ctnlogin">
                
                
                @if(Auth::check())
                    @if(Auth::user()->role == 1)
                        <a href="{{ route('getListCate') }}" class="user_acount">Quản lý</a>
                    @else
                        <a href="{{ route('getProfile') }}" class="user_acount">Tài khoản</a>
                    @endif
                    <a href="{{ route('logout') }}" class="logout">Đăng xuất</a>
                @else
                    <a href="{{ route('register') }}" class="register">Đăng ký</a>
                    <a href="{{ route('login') }}" class="login">Đăng nhập</a>
                @endif

                <div class="from">
                    <div class="f">From | </div>
                    <div class="imageflag"><img src="{{ asset('images/vietnam.png') }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="container_h_b">
            <div class="logo"><img src="{{ asset('images/logoktm.jpg') }}" alt="image"></div>
            <div class="ctnsearch">
                <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center;">
                    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="{{ request('keyword') }}" />
                    <button type="submit" class="btnsearch"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <a href="{{ route('getCart') }}" class="cart">
                <label>Giỏ hàng</label>
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart_count" id="cart-count">{{ $cartItems->sum('quantity')}}</span>
            </a>
        </div>
        <div class="container_h_f">
            <a href="{{ route('trangchu') }}" class="item active">Trang chủ</a>
            <a href="#" class="item">Sản phẩm</a>
            <div class="dropdown">
                <a href="#" class="item">Danh mục <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    @foreach($categories as $cate)
                        <a href="{{ route('search') }}?category_id={{ $cate->id }}">{{ $cate->name }}</a>
                    @endforeach
                </div>
            </div>
            <a href="#" class="item">Liên hệ</a>
        </div>
    </Header>
    
