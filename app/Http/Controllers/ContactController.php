<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactPageSetting;
use App\Notifications\NewContactNotification;
use Auth;
use App\Models\User;
use Notification;


class ContactController extends Controller
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
        $data = $request->all();
        if(Auth::id()){
            $data['user_id'] = Auth::id();
        }
        
        
        $contact = Contact::create($data);
            
        $admin_email = User::where('is_admin','admin')->first();
        
        Notification::sendNow($admin_email, new NewContactNotification($contact));
    }
}
