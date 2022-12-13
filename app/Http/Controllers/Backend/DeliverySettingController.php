<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DeliverySetting;
use Illuminate\Http\Request;

class DeliverySettingController extends Controller
{
    public function deliverySettingStore(Request $request){
        DeliverySetting::create(
            $request->validate([
                'delivery_title' => 'required',
                'delivery_cost' => 'integer',
            ])
        );
    }

    public function index()
    {
        $deliverySetting = DeliverySetting::all();
        return response()->json($deliverySetting); 
    }

    public function update(Request $request,DeliverySetting $deliverySetting){
        $deliverySetting->update(
            $request->validate([
                'delivery_title' => 'required',
                'delivery_cost' => 'integer',
            ])
        );
    }
}
