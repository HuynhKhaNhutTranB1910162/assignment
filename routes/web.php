<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ServicePackageController;
use App\Http\Controllers\Admin\AccountAdminController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\Admin\AppointmentAdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\chartController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleLoginController;

use App\Http\Controllers\Shipper\ShipperPageController;
use App\Http\Controllers\Shipper\ShipperProfileController;

use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AppointmentClientController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\ProductReviewController as ClientProductReviewController;
use App\Http\Controllers\Client\ServiceController as ClientServiceController;
use App\Http\Controllers\Client\OrderHistoryController as ClienOrderHistoryController;
use App\Http\Controllers\Client\FavoriteController as ClienFavoriteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//Client
Route::get('/', [ClientController::class,'index'])->name('client');
Route::get('/shop', [ClientProductController::class,'index'])->name('shop');
Route::get('/product/{id}', [ClientProductController::class,'showDetail'])->name('product-detail');
Route::get('/client-service', [ClientServiceController::class,'index'])->name('client-service');
Route::get('/service/{id}', [ClientServiceController::class,'showDetail'])->name('service-detail');

Route::get('/cart', [ClientCartController::class,'index'])->name('cart-product');
Route::post('/cart/{id}', [ClientProductController::class,'addToCart'])->name('cart.addToCart');
Route::put('/cart-update', [ClientCartController::class,'update'])->name('cart.update');
Route::get('/cart-delete/{id}', [ClientCartController::class,'destroy'])->name('cart.delete');

Route::get('/user-profile', [ClientProfileController::class,'index'])->name('profile')->middleware(['auth', 'verified']);
Route::get('/user-edit-profile/{id}', [ClientProfileController::class,'edit'])->name('profile.edit-user');
Route::put('/user-update-user/{id}', [ClientProfileController::class,'update'])->name('profile.update-user');
Route::put('/user-update-password-user/{id}', [ClientProfileController::class, 'updatePassword'])->name('profile.update-password-user');
Route::get('/user-profile-delete/{id}', [ClientProfileController::class,'destroy'])->name('profile.delete');

Route::get('/order', [ClientOrderController::class,'index'])->name('order')->middleware(['auth', 'verified']);
Route::get('/order-history', [ClienOrderHistoryController::class,'index'])->name('order.history')->middleware(['auth', 'verified']);
Route::get('/order-detail/{id}', [ClienOrderHistoryController::class,'detail'])->name('order.detail')->middleware(['auth', 'verified']);
Route::put('/order-review/{id}', [ClientOrderController::class,'review'])->name('order.review');
Route::get('/order-detail-update/{id}', [ClienOrderHistoryController::class, 'cancel'])->name('orders.detail.update')->middleware(['auth', 'verified']);
Route::get('/thankyou', [ClienOrderHistoryController::class,'thankyou'])->name('thankyou')->middleware(['auth', 'verified']);

Route::get('/order-history-pending', [ClienOrderHistoryController::class,'pending'])->name('order.history.pending')->middleware(['auth', 'verified']);
Route::get('/order-history-accepted', [ClienOrderHistoryController::class,'accepted'])->name('order.history.accepted')->middleware(['auth', 'verified']);
Route::get('/order-history-inDelivery', [ClienOrderHistoryController::class,'inDelivery'])->name('order.history.inDelivery')->middleware(['auth', 'verified']);
Route::get('/order-history-success', [ClienOrderHistoryController::class,'success'])->name('order.history.success')->middleware(['auth', 'verified']);
Route::get('/order-history-cancel', [ClienOrderHistoryController::class,'cancels'])->name('order.history.cancel')->middleware(['auth', 'verified']);

Route::get('/favorite', [ClienFavoriteController::class,'index'])->name('favorite')->middleware(['auth', 'verified']);
Route::post('/favorite/{id}', [ClientProductController::class,'addToFavorite'])->name('favorite.addToFavorite');
Route::get('/favorite-delete/{id}', [ClienFavoriteController::class,'destroy'])->name('favorite.delete');

Route::post('/add-appointment', [AppointmentClientController::class,'store'])->name('appointment.store');

Route::post('/comment-product/{id}', [ClientProductReviewController::class,'comments'])->name('comment.product');

Route::get('order-paymentCallback', [ClienOrderHistoryController::class, 'paymentCallback'])->name('order.paymentCallback');

Route::get('auth/{provider}/redirect', [GoogleLoginController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [GoogleLoginController::class, 'callback'])->name('socialite.callback');


Auth::routes(['verify' => true]);

Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/shipper/login',[LoginController::class,'showShipperLoginForm'])->name('shipper.login-view');
Route::post('/shipper/login',[LoginController::class,'shipperLogin'])->name('shipper.login');

Route::middleware(['auth:admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    Route::get('/profile/{id}', [ProfileController::class,'index'])->name('profile.edit');
    Route::put('/update-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/update-profile-password-admin/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update-password-admin');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/create-categories', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store-categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit-categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update-categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/delete-categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/create-products', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store-products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit-products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/update-products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/delete-products/{id}', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('delete-product-image/{id}', [ProductController::class ,'deleteProductImage'])->name('product.delete-image');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/create-users', [UserController::class, 'create'])->name('users.create');
    Route::post('/store-users', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update-users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::put('/update-users-password/{id}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/delete-users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/admins', [AccountAdminController::class, 'index'])->name('admins');
    Route::get('/create-admins', [AccountAdminController::class, 'create'])->name('admins.create');
    Route::post('/store-admins', [AccountAdminController::class, 'store'])->name('admins.store');
    Route::get('/edit-admins/{id}', [AccountAdminController::class, 'edit'])->name('admins.edit');
    Route::put('/update-admins/{id}', [AccountAdminController::class, 'update'])->name('admins.update');
    Route::put('/update-admins-password/{id}', [AccountAdminController::class, 'updatePassword'])->name('admins.update-password');
    Route::get('/delete-admins/{id}', [AccountAdminController::class, 'destroy'])->name('admins.delete');

    Route::get('/banners', [BannerController::class, 'index'])->name('banners');
    Route::get('/create-banners', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/store-banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/edit-banners/{id}', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/update-banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::get('/delete-banners/{id}', [BannerController::class, 'destroy'])->name('banners.delete');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/create-services', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/store-services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/edit-services/{id}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/update-services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::get('/delete-services/{id}', [ServiceController::class, 'destroy'])->name('services.delete');

    Route::get('/service-packages', [ServicePackageController::class, 'index'])->name('service-packages');
    Route::get('/create-service-packages', [ServicePackageController::class, 'create'])->name('service-packages.create');
    Route::post('/store-service-packages', [ServicePackageController::class, 'store'])->name('service-packages.store');
    Route::get('/edit-service-packages/{id}', [ServicePackageController::class, 'edit'])->name('service-packages.edit');
    Route::put('/update-service-packages/{id}', [ServicePackageController::class, 'update'])->name('service-packages.update');
    Route::get('/delete-service-packages/{id}', [ServicePackageController::class, 'destroy'])->name('service-packages.delete');

    Route::get('/orders', [OrderAdminController::class, 'index'])->name('orders');
    Route::get('/edit-oders/{id}', [OrderAdminController::class, 'edit'])->name('orders.edit');
    Route::put('/update-oders/{id}', [OrderAdminController::class, 'update'])->name('orders.update');

    Route::get('/receipts', [ReceiptController::class,'index'])->name('receipts');
    Route::get('/create-receipt', [ReceiptController::class, 'create'])->name('receipts.create');
    Route::post('/addReceipt-receipts', [ReceiptController::class, 'addReceipt'])->name('receipts.addReceipt');
    Route::get('/show-receipt', [ReceiptController::class, 'getReceiptProduct'])->name('receipts.getReceiptProduct');
    Route::post('/store-receipts', [ReceiptController::class, 'store'])->name('receipts.store');
    Route::post('/addQtyAndPrice-receipts', [ReceiptController::class, 'addQtyAndPrice'])->name('receipts.addQtyAndPrice');
    Route::get('/edit-receipt/{id}', [ReceiptController::class, 'edit'])->name('receipts.edit');
    Route::put('/update-receipt/{id}', [ReceiptController::class, 'update'])->name('receipt.update');
    Route::get('/delete-receipt/{id}', [ReceiptController::class, 'destroy'])->name('receipt.delete');
    Route::get('/show-detail-receipt/{id}', [ReceiptController::class, 'show'])->name('receipt.show');

    Route::get('/shippers', [ShipperController::class, 'index'])->name('shippers');
    Route::get('/create-shippers', [ShipperController::class, 'create'])->name('shippers.create');
    Route::post('/store-shippers', [ShipperController::class, 'store'])->name('shippers.store');
    Route::get('/edit-shippers/{id}', [ShipperController::class, 'edit'])->name('shippers.edit');
    Route::put('/update-shippers/{id}', [ShipperController::class, 'update'])->name('shippers.update');
    Route::put('/update-shippers-password/{id}', [ShipperController::class, 'updatePassword'])->name('shippers.update-password');
    Route::get('/delete-shippers/{id}', [ShipperController::class, 'destroy'])->name('shippers.delete');

    Route::get('/appointments', [AppointmentAdminController::class, 'index'])->name('appointments');
    Route::get('/edit-appointment/{id}', [AppointmentAdminController::class, 'edit'])->name('appointment.edit');
    Route::put('/update-appointment/{id}', [AppointmentAdminController::class, 'update'])->name('appointment.update');

    Route::get('/getChartOnlyMonth', [ChartController::class, 'getChartOnlyMonth'])->name('getChartOnlyMonth-revenue');
    Route::get('/filterGetChartOnlyMonth', [ChartController::class, 'filterGetChartOnlyMonth'])->name('filterGetChartOnlyMonth-revenue');
    Route::get('/chartTopSellingProductsYear', [ChartController::class, 'chartTopSellingProducts'])->name('topSellingProducts-revenue');
    Route::get('/chartTopSellingProductOnlyMonth', [ChartController::class, 'chartTopSellingProductOnlyMonth'])->name('chartTopSellingProductOnlyMonth-revenue');
    Route::get('/ChartStatusOrder', [ChartController::class, 'ChartStatusOrder'])->name('ChartStatusOrder-revenue');
    Route::get('/chartStatusOrderOnlyMonth', [ChartController::class, 'chartStatusOrderOnlyMonth'])->name('chartStatusOrderOnlyMonth-revenue');

    Route::get('/orderListPending', [OrderAdminController::class,'pending'])->name('orderListPending');
    Route::get('/orderListAccepted', [OrderAdminController::class,'accepted'])->name('orderListAccepted');
    Route::get('/orderListSuccess', [OrderAdminController::class,'success'])->name('orderListSuccess');
    Route::get('/orderListListCancel', [OrderAdminController::class,'cancel'])->name('orderListCancel');
    Route::get('/orderListInDelivery', [OrderAdminController::class,'inDelivery'])->name('orderListInDelivery');
});

Route::middleware(['auth:shipper'])->group(function () {
    Route::get('/shipperList', [ShipperPageController::class,'list'])->name('shipperList');
    Route::get('/edit-shipperPage/{id}', [ShipperPageController::class, 'edit'])->name('shipperPage.edit');
    Route::put('/update-shipperPage/{id}', [ShipperPageController::class, 'update'])->name('shipperPage.update');

    Route::get('/shipper/{id}', [ShipperProfileController::class,'index'])->name('shipper.edit');
    Route::put('/update-shipper/{id}', [ShipperProfileController::class, 'update'])->name('shipper.update');
    Route::put('/update-shipper-password-profile/{id}', [ShipperProfileController::class, 'updatePassword'])->name('shipper.update-password-profile');

    Route::get('/shipperListPending', [ShipperPageController::class,'pending'])->name('shipperListPending');
    Route::get('/shipperListAccepted', [ShipperPageController::class,'accepted'])->name('shipperListAccepted');
    Route::get('/shipperListSuccess', [ShipperPageController::class,'success'])->name('shipperListSuccess');
    Route::get('/shipperListCancel', [ShipperPageController::class,'cancel'])->name('shipperListCancel');
    Route::get('/shipperListRefund', [ShipperPageController::class,'refund'])->name('shipperListRefund');
});
