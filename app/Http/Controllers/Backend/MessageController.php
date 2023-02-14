<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index(){
        $messages = Contact::latest()->get();
        return response()->json(
           $messages
        );
    }

    public function deleteOldMessage(){
        $date = Carbon::now()->subMonths(4)->format('Y-m-d');
        $messages = Contact::where('created_at', '<=', $date)->get();
        
        foreach($messages as $message){
            $message->delete();
        }
    }
}
