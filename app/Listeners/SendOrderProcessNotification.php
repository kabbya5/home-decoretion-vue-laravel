<?php

namespace App\Listeners;

use App\Events\OrderProcessedEvent;
use App\Mail\OrderStatsChangeMail;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendOrderProcessNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(OrderProcessedEvent $event)
    {
        $user = User::where('id',$event->user_id)->first();
        $user_name = $user->first_name.$user->last_name;

        Mail::to($user->email)->send(new OrderStatsChangeMail($event->order,$event->status,$event->order_details,$user_name));
    }
}
