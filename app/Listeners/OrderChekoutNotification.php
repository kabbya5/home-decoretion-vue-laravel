<?php

namespace App\Listeners;

use App\Events\OrderCheckoutEvent;
use App\Mail\OrderConformationMail;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminOrderCreateNotificaton;
use App\Notifications\UserOrderConfomation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use Notification;

class OrderChekoutNotification
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

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCheckoutEvent  $event
     * @return void
     */
    public function handle(OrderCheckoutEvent $event)
    {
        $user = User::where('id', Auth::id())->first();
        $admin = User::where('is_admin','admin')->first();

        $order = Order::where('id',$event->order)->first();

        
        // Mail::to($user->email)->send(new OrderConformationMail($order));
        
        Notification::send($admin, new AdminOrderCreateNotificaton($order));
    
        Notification::send($user, new UserOrderConfomation($order));
            
    
    }
}
