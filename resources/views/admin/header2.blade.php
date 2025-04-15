<div class="headside">
    <div class="search">
        <input type="text" name="search" placeholder="Tìm kiếm..."/>
        <button class="btnsearch"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="box">
        <h2>Danh mục</h2>
        <div class="item"><a href="{{ route('getListCate') }}">Danh sách danh mục</a></div>
        <div class="item"><a href="{{ route('getAddCate') }}">Thêm danh mục</a></div>
    </div>
    <div class="box">
        <h2>Sản phẩm</h2>
        <div class="item"><a href="{{ route('getListPro') }}">Danh sách sản phẩm</a></div>
        <div class="item"><a href="{{ route('getAddPro') }}">Thêm sản phẩm</a></div>
    </div>
    <div class="box">
        <h2>Người dùng</h2>
        <div class="item"><a href="{{ route('getListUser') }}">Danh sách người dùng</a></div>
    </div>
    <div class="box">
        <h2>Đơn hàng</h2>
        <div class="item"><a href="{{ route('getOrderList') }}">Danh sách đơn hàng</a></div>
        <div class="item"><a href="{{ route('getOrderListCompleted') }}">Đơn hàng đã giao thành công</a></div>
        <div class="item"><a href="{{ route('getOrderListCancelled') }}">Đơn hàng đã hủy</a></div>
    </div>
</div>