<?php

namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderProcessedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $order;
    public $status;
    public $order_details;

    public function __construct($user_id,$order,$status,$order_details)
    {
        $this->user_id = $user_id;
        $this->order = $order;
        $this->status = $status;
        $this->order_details = $order_details;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
