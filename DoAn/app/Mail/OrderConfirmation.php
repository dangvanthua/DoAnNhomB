<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderItem;

    public function __construct($order, $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
            ->with([
                'order' => $this->order,
                'orderItems' => $this->orderItem,
            ]);
    }
}
