<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactPageSettingStoreRequest;
use App\Models\ContactPageSetting;
use Illuminate\Http\Request;

class ContactPageSettingController extends Controller
{
    public function index(){
        $contactSetting = ContactPageSetting::first();
        return response()->json($contactSetting);
    }
    public function store(ContactPageSettingStoreRequest $request){
        ContactPageSetting::create($request->all());
    }

    public function update(ContactPageSettingStoreRequest $request,ContactPageSetting $contactPageSetting)
    {
        $contactPageSetting->update(
            $request->all()
        );
    }
}
