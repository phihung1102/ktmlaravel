<!DOCTYPE html>
<html>
<head>
    <title>Đặt hàng thành công</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .order-details { margin-top: 20px; border: 1px solid #ddd; padding: 15px; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Đơn hàng của bạn đã được đặt thành công!</h2>
        </div>
        
        <div class="content">
            <p>Xin chào {{ $user->fullname }},</p>
            <p>Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Dưới đây là thông tin đơn hàng của bạn:</p>
            
            <div class="order-details">
                <h3>Thông tin đơn hàng #{{ $order->id }}</h3>
                <p>{{ $order->user_od->fullname }}</p>
                <p>{{ $order->user_od->phone }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->date_order->format('d/m/Y H:i') }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái:</strong> Đang xử lý</p>
            </div>
            
            <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.</p>
            <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại hỗ trợ.</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>