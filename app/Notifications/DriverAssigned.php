<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DriverAssigned extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Can also add 'mail', 'sms', etc.
    }

    public function toDatabase($notifiable)
    {
        return [
            'message'    => "🚛 New Order Assigned! Order ID: #{$this->order->id}",
            'order_id'   => $this->order->id,
            'status'     => $this->order->order_status,
            'address'    => $this->order->shipping_address,
            'amount'     => $this->order->total_amount,
            'created_at' => now()->format('Y-m-d H:i:s'),
        ];
    }
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
