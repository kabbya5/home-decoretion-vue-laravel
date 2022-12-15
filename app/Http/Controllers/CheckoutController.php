<?php

namespace App\Http\Controllers;

use App\Models\DeliverySetting;
use Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getDeliverySettings(){

        return response()->json([
            'coupon' => Session::get('coupon'),
            'deliverySeystem' => DeliverySetting::all()
        ]);
    }

    public function orderStore(Request $request){
        $request->validate([
            
        ])
    }
}
