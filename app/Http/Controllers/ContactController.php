<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactPageSetting;
use App\Notifications\NewContactNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use Illuminate\Bus\Queueable;

class ContactController extends Controller implements ShouldQueue
{
    public function getSetting(){
        $contactSetting = ContactPageSetting::first();
        return response()->json($contactSetting);
    }

    public function sentContactMessage(Request $request){
        $request->validate([
            'contact_name' => 'required',
            'contact_phone' => 'required|regex:/(01)[0-9]{9}/',
            'contact_email' => 'required|email',
            'contact_subject' => 'required',
            'contact_description' => 'required|min:40|max:1020',
        ]);
        $contact =  \Auth::user()->contacts()->create(
            $request->all()
        );
        $contact['user'] = \Auth::user();

        $admin_email = User::where('is_admin',1)->first();
        
        Notification::sendNow($admin_email, new NewContactNotification($contact));
    }
}
