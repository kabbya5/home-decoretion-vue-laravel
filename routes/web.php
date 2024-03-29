<?php


use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ContactPageSettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DeliverySettingController;
use App\Http\Controllers\Backend\DevelopmentPageCategoryController;
use App\Http\Controllers\Backend\DevelopmentPageController;
use App\Http\Controllers\Backend\DevelopmentPageValueController;
use App\Http\Controllers\Backend\HomepageSettingController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PageImageController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\UserMangeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NavbarRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ResentViewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\WishlistController;
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


Route::get('/', function () {
    return view('home');
});

//admin 
Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin','verified']],
function(){

  Route::controller(AdminDashboardController::class)->group(function(){
    Route::get('/dashboard','index');
    Route::get('/dashboard/content','dashboardContent');
    Route::get('/navbar/content/','navBarContent');
  });

  // category 
  Route::controller(CategoryController::class)->group(function(){
    Route::get('/category','index');
    Route::post('/category','store');
    Route::put('/category/update/{category}','update');
    Route::delete('/category/delete/{category}','destroy');
    Route::post('/category/restore/{id}','restore');
    Route::get('/category/trashed','trashed');
    Route::delete('/category/force/delete/{id}','forceDelete');
  });

  //subcategory 

  Route::resource('/subcategory',SubcategoryController::class)->only(['destroy','index','store']);
  Route::controller(SubcategoryController::class)->group(function (){
      Route::post('/subcategory/restore/{id}','restore');
      Route::get('/subcategory/trashed','trashed');
      Route::delete('/subcategory/permament/delete/{subcatgory}','forceDelete');
      Route::put('/subcatgory/update/{id}','update');
  });

  //childCategory 

  Route::resource('/childcategory', ChildCategoryController::class)->only(['destroy','index','store']);
  Route::controller(ChildCategoryController::class)->group(function (){
    Route::put('/childcategory/update/{childcategory}','update');
  });

  // brand 
  Route::resource('/brand',BrandController::class)->only(['destroy','index','store']);
  Route::controller(BrandController::class)->group(function (){
      Route::put('/brand/update/{brand}','update');
  });

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
  
  Route::controller(PageController::class)->group(function(){
    Route::post('/page/create','store');
    Route::get('/page/index','index');
    Route::put('/page/update/{page}','update');
  });

  Route::controller(HomepageSettingController::class)->group(function(){
    Route::get('/hompage/entry','indexHomepageEntry');
    Route::post('/hompage/entry/create','cratetHomePageEntry');
    ROute::put('/hompage/entry/update/{homepage_entry}','updateHomePageEntry');
  });

  // Contact PageSetting 

  Route::controller(ContactPageSettingController::class)->group(function(){
    Route::post('/contact/page/settings','store');
    Route::put('/contact/page/settings/{contactPageSetting}','update');
    Route::get('/contact/page/settings/','index');
  });

  //development page or extra page 

  Route::controller(DevelopmentPageController::class)->group(function(){
    Route::post('/development/page/title/create','storeTitle');
    Route::get('/development/page/title/index','titleIndex');
    Route::put('/development/page/title/update/{id}','titleUpdate');
  });

  Route::controller(PageImageController::class)->group(function(){
    Route::get('/developmnet/page/image/index','index');
    Route::post('/development/page/image/create','store');
    Route::put('/development/page/image/update/{developmentpageimage}','update');
    Route::delete('/developmnet/page/image/delete/{developmentpageimage}','destroy');
  });

  Route::controller(DevelopmentPageCategoryController::class)->group(function(){
    Route::get('/development/page/category/index','index');
    Route::post('/developmnet/page/category/store','store');
    Route::put('/development/page/category/update/{category}', 'update');
  });

  Route::controller(DevelopmentPageValueController::class)->group(function(){
    Route::get('/development/page/values','index');
    Route::post('/development/page/value/store','store');
    Route::put('/development/page/value/update/{value}','update');
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

  // colors 
  Route::controller(ColorController::class)->group(function(){
    Route::post('/product/color/create','store');
    Route::get('/product/color','index');
    Route::put('/product/color/update/{color}','update');
  });


  // Sizes 
  Route::controller(SizeController::class)->group(function(){
    Route::get('/size/index','index');
    Route::put('/size/update/{size}','update');
    Route::post('/size/store','store');
  });

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

  // order 

  Route::controller(OrderController::class)->group(function(){
    Route::get('/all/orders/{status}','allOrders');
    Route::get('/order/{slug}','show');
    Route::put('/order/update/{order}', 'update');
  });

  //user mange controller 

  Route::controller(UserMangeController::class)->group(function(){
    Route::get('/users/{status}', 'index');
    Route::delete('/user/delete/{id}', 'delete');
    Route::get('/user/show/{slug}','show');
    Route::put('/user/profile/update/{user}', 'update');
    Route::put('/user/role/change/{user}','UserRoleChange');
  });

  // Message 

  Route::controller(MessageController::class)->group(function(){
    Route::get('/message/index', 'index');
    Route::delete("/message/delete",'deleteOldMessage');
  });

});

// user 

// home page 
Route::controller(HomePageController::class)->group(function (){
  Route::get('/get/cateogry/index/{width}','getCategory');
  Route::get('/get/hom/page/content','getHomePageContent');
  Route::get('/get/sliders','getSliders');
});

// Footer 

Route::controller(FooterController::class)->group(function(){
  Route::get('/footer/content','index');
});

// page detials for user and admin for admin page controller 

Route::get('/page/details/{slug}',[PageController::class,'show']);
//product details 
Route::controller(ProductDetailController::class)->group(function (){
  Route::get('/product/{slug}','productDetails');
});

Route::controller(NavbarRequestController::class)->group(function (){
  Route::get('/get/navbar/content','getNavbarContents');
  Route::get('/navbar/category','getNavbarCategory');
  Route::get('/search/tags/','searchTags');
});

//shop route for shop page

Route::controller(ShopController::class)->group(function(){
  Route::get('get/shop/products/{status}', 'shopPageProducts');
  Route::get('/shop/tag/product/{tag}','tagProduct');
  Route::get('/shop/page/sidebar/contents','shopPageContents');
  Route::get('/shop/category/product/{slug}','categoryProducts');
  Route::get('/shop/subcat/product/{slug}','subCategoryProducts');
  Route::get('/shop/childcat/product/{slug}','childCategoryProducts');
  Route::get('/shop/slider/product/{slug}', 'sliderProduct');
});

// contact 
Route::controller(ContactController::class)->group( function(){
  Route::get('/contact/page/setting','getSetting');
  Route::post('/contact/message/sent','sentContactMessage');
});

//  Cart  and coupon 

Route::controller(ShoppingCartController::class)->group(function (){
  Route::get('/shopping/carts/index','index');
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

// wishlist 
Route::controller(WishlistController::class)->group(function (){
  Route::post('/wishlist/add/{product}','addProductToWishlist');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth','verified']],
function(){

  Route::controller(CheckoutController::class)->group(function (){
    Route::put('/order/store/','orderStore');
  });
  // user dashboard 

  Route::controller(ProfileController::class)->group(function (){
    Route::get('/get','getCurrentUser');
    Route::put('/profile/update/{user}','updateProfile');
  });

  // user orders 

  Route::controller(UserOrderController::class)->group(function(){
    Route::get('/orders','index');
    Route::get('/order/details/{slug}','userOrderDetails');
  });

  Route::controller(ResentViewController::class)->group(function (){
    Route::get('/resent/view/products', 'getProducts');
  });

  // Wishlist 

  Route::controller(WishlistController::class)->group(function (){
    Route::get('/wishlists','index');
    Route::delete('/wishlists/{wishlist}', 'delete');
  });
  // notificaton for admin and user 
});



Route::get('/notifications',[NotificationController::class,'getNotification']);


Route::get('/admin/{any}', [AdminDashboardController::class,'index'])
->where('any','.*');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
  ->where('any','.*')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

