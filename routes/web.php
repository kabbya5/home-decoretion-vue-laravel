<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Backend\AdminBashbordController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ContactPageSettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DeliverySettingController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NavbarRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Models\Coupon;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);
Route::get('/email/verify', [HomeController::class,'verifyEmail']);
Route::get('/admin/dashboard/',[AdminBashbordController::class,'index']);


Route::get('/', function () {
    return view('home');
});

//admin 
Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin','verified']],
function(){
  //site-setting

  Route::post('/site/setting/create',[SiteSettingController::class,'store']);
  Route::get('/site/setting/edit',[SiteSettingController::class,'edit']);
  Route::put('/site/setting/update/{site_setting}/',[SiteSettingController::class,'update']);

  Route::post('/site/setting/social/midia/links/create',[SiteSettingController::class,'storeSocialMediaLink']);
  Route::get('/site/setting/social/midia/links',[SiteSettingController::class,'getSocialMediaLink']);
  Route::put('/site/setting/social/midia/links/update/{socialMedia}',[SiteSettingController::class,'updateSocialMediaLink']);

  // DeliverySetting 
  Route::controller(DeliverySettingController::class)->group(function(){
    Route::post('/delivery/setting/create','deliverySettingStore');
    Route::get('/delivery/settings','index');
    Route::put('/delivery/setting/{deliverySetting}','update');
  });

  //page setting 
  Route::controller(ContactPageSettingController::class)->group(function(){
    Route::post('/contact/page/settings','store');
    Route::put('/contact/page/settings/{contactPageSetting}','update');
    Route::get('/contact/page/settings/','index');
  });

  // product 

  Route::get('/products',[ProductController::class,'index']);
  Route::get('/product/create',[ProductController::class,'create']);
  Route::post('/product/store',[ProductController::class,'store']);
  Route::get('/product/edit/{product}',[ProductController::class,'edit']);
  Route::put('/product/update/{product}',[ProductController::class,'update']);
  Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);
  Route::post('/product/restore/{id}',[ProductController::class,'restore']);
  Route::get('/product/trashed',[ProductController::class,'trashed']);
  Route::delete('/product/force/delete/{slug}',[ProductController::class,'forceDelete']);

  Route::controller(ColorController::class)->group(function(){
    Route::post('/product/color/create','store');
    Route::get('/product/color','index');
    Route::put('/product/color/update/{color}','update');
  });
  Route::post('/size/store',[SizeController::class,'store']);

  // Tag 

  Route::controller(TagController::class)->group(function(){
    Route::get('/tag/index','index');
    Route::post('/tag/store','store');
    Route::put('/tags/update/{id}','update');
    Route::delete('/tag/delete/{id}','delete');
  });

  // Image 
  Route::controller(ProductImageController::class)->group(function(){
    route::get('/product/image','index');
    Route::post('/product/image/create','store');
    Route::put('/product/image/update/{productImage}','update');
    Route::delete('/product/image/{productImage}', 'destroy');
    Route::post('/product/image/restore/{productImage}','restore');
    Route::get('/product/image/trashed','trashed');
    Route::delete('/product/image/force/delete/{id}', 'forceDelete');
  });

  // Slider 
  Route::resource('/slider',SliderController::class)->except(['show',]);
  Route::controller(SliderController::class)->group(function (){
      Route::put('/slider/update/{slider}','update');
      Route::put('/slider/publish/datate/change/{slider}','changePublishedDate');
  });

  // Coupon 
  Route::resource('/coupon',CouponController::class)->except(['create','show','edit']);
  Route::put('/coupon/activity/change/{coupon}',[CouponController::class,'couponActiveUnactive']);

});

// user 

// home page 
Route::controller(HomePageController::class)->group(function (){
  Route::get('/get/cateogry/index/{width}','getCategory');
  Route::get('/get/week/products','weekSaleProduct');
  Route::get('/get/sliders','getSliders');
});

//product details 

Route::controller(ProductDetailController::class)->group(function (){
  Route::get('/product/{slug}','productDetails');
});

Route::controller(NavbarRequestController::class)->group(function (){
  Route::get('/get/navbar/site/setting','getSiteSetting');
  Route::get('/navbar/category','getNavbarCategory');
  Route::get('/search/tags/','searchTags');
  ROute::get('/cart/content','getNavbarCatContent');
});

//shop route for shop page

Route::controller(ShopController::class)->group(function(){
  Route::get('/shop/tag/product/{tag}','tagProduct');
  Route::get('/shop/page/sidebar/contents','shopPageContents');
  Route::get('/shop/category/product/{slug}','categoryProducts');
  Route::get('/shop/subcat/product/{slug}','subCategoryProducts');
  Route::get('/shop/childcat/product/{slug}','childCategoryProducts');
});

// contact 
Route::controller(ContactController::class)->group( function(){
  Route::get('/contact/page/setting','getSetting');
  Route::post('/contact/message/sent','sentContactMessage');
});

//  Cart  and coupon 

Route::controller(ShoppingCartController::class)->group(function (){
  Route::post('/cart/add/{product}','addCart');
  Route::put('/update/cart/{rowId}', 'updateCartQty');
  Route::delete('/remove/cart/product/{rowId}','removedCartProduct');
  Route::get('/shopping/carts','cartContent');
  Route::delete('/cart/destroy','cartDestroy');
  Route::get('/coupon/check','applyCoupon');
});

Route::controller(CheckoutController::class)->group(function (){
  Route::get('/get/delivery/setting','getDeliverySettings');
  Route::put('/order/store/','orderStore');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth','verified']],
function(){
  // user dashboard 

  Route::controller(ProfileController::class)->group(function (){
    Route::get('/get','getCurrentUser');
    Route::put('/profile/update/{user}','updateProfile');
  });

  

  // notificaton for admin and user 
  

});



Route::get('/notifications',[NotificationController::class,'getNotification']);


Route::get('/admin/{any}', [AdminBashbordController::class,'index'])
->where('any','.*');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
  ->where('any','.*')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

