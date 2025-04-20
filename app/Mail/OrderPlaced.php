<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    public function __construct(Order $order, $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('[Thông báo] Đơn hàng #' . $this->order->id . ' đã được đặt thành công')
                   ->view('emails.order_placed')
                   ->with([
                       'order' => $this->order,
                       'user' => $this->user,
                   ]);
    }
}