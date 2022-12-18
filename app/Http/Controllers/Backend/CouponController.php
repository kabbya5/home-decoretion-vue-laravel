<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        if($coupons->count() > 1){
            $couponCounts = $coupons->count() . ' copons';
        }else{
            $couponCounts = $coupons->count() . ' copon';
        }

        return response()->json([
            'coupons' => $coupons,
            'couponsCount' => $couponCounts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupon::create($request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'discount'  => 'required|integer',
        ]));
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name,'.$coupon->id,
            'discount'  => 'required',
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */

    public function couponActiveUnactive(Request $request,Coupon $coupon){
        $coupon->update([
            'is_active' => $request->is_active 
        ]);
    }
    public function destroy(Coupon $coupon)
    {
        //
    }
}
