<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Order $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown:'client.email.order-mail',
            with: [
                'notes' => $this->order->notes,
                'user_id' => $this->order->user_id,
                'user_name' => $this->order->user_name,
                'phone' => $this->order->phone,
                'tracking_number' => $this->order->tracking_number,
                'status' => $this->order->status,
                'shipping_address' => $this->order->shipping_address,
                'total' => $this->order->total,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
