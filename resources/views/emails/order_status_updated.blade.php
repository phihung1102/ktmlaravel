<!DOCTYPE html>
<html>
<head>
    <title>Cập nhật trạng thái đơn hàng</title>
</head>
<body>
    <h2>Đơn hàng #{{ $order->id }} đã được cập nhật</h2>
    <p><strong>Trạng thái mới:</strong> {{ $newStatus }}</p>
    <p><strong>Ngày cập nhật:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }} $</p>
    
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
</body>
</html>