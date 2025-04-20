<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $oldStatus;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order  $order
     * @param  string  $oldStatus
     * @return void
     */
    public function __construct(Order $order, $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        $statusMap = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đang giao hàng',
            'completed' => 'Đã hoàn thành',
            'cancelled' => 'Đã hủy'
        ];

        $oldStatusVi = $statusMap[$this->oldStatus] ?? $this->oldStatus;
        $newStatusVi = $statusMap[$this->order->status] ?? $this->order->status;

        return $this->subject('Cập nhật trạng thái đơn hàng #'.$this->order->id)
                    ->view('emails.order_status_updated')
                    ->with([
                        'order' => $this->order,
                        'oldStatus' => $oldStatusVi,
                        'newStatus' => $newStatusVi
                    ]);
    }

}
