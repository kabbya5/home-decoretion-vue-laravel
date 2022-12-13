<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Carbon\Carbon;

class NotificationController extends Controller
{
   public function getNotification()
   {
        $user = User::where('is_admin',1)->first();

         foreach($user->unreadNotifications as $notification){
            $notification['created_data'] = $notification['created_at']->diffForHumans();
         }

         $notifications = $user->unreadNotifications;
         return response()->json($notifications);
   }
}
