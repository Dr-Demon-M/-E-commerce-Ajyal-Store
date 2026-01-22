<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $address = $this->order->billingAddress;

        return (new MailMessage)
            ->subject("New Order Created #{$this->order->number}")
            ->greeting("Hi {$notifiable->name}")
            ->line("New Order Created #{$this->order->number} And Created By {$address->name} From {$address->country}")
            ->action('View Order', url('/admin/dashboard'));
    }

    public function toDatabase($notifiable)
    {
        $address = $this->order->billingAddress;

        return [
            'body' => "New Order Created #{$this->order->number}",
            'Customer' => "Created By {$address->name} From {$address->country}",
            'icon' => 'fas fa-envelope mr-2 text-info',
            'url' => url("/admin/dashboard/orders/{$this->order->id}"),
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $address = $this->order->billingAddress;

        return new BroadcastMessage([
            'body' => "New Order Created #{$this->order->number}",
            'Customer' => "Created By {$address->name} From {$address->country}",
            'icon' => 'fas fa-envelope mr-2 text-info',
            'url' => url("/admin/dashboard/orders/$this->order->id"),
            'order_id' => $this->order->id,
        ]);
    }
}
