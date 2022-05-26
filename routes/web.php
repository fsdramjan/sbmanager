<?php

use App\Http\Controllers\Backend\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Auth\AdminRegistrationController;
use App\Http\Controllers\Backend\Auth\AdminResetPasswordController;
use App\Http\Controllers\Backend\Auth\BackendManagementController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Customer\ConsumerController;
use App\Http\Controllers\Customer\Auth\CustomerForgotPasswordController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\Auth\CustomerRegisterController;
use App\Http\Controllers\Customer\Auth\CustomerResetPasswordController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\EmployeeController;
use App\Http\Controllers\Customer\SupplierController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/customer')->as('customer.')->middleware('guest:customer')->group(function () {
    Route::get('/register', [CustomerRegisterController::class, 'register'])->name('register');
    Route::post('/register', [CustomerRegisterController::class, 'storeRegister']);

    Route::get('/login', [CustomerLoginController::class, 'login'])->name('login');
    Route::post('/login', [CustomerLoginController::class, 'storeLogin']);

    Route::get('/forgot-password', [CustomerForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [CustomerForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [CustomerResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [CustomerResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/customer')->as('customer.')->middleware('auth:customer')->group(function () {
    Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
    Route::post('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

    Route::controller(ShopController::class)->prefix('/shop')->as('shop.')->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::post('/store', 'store')->name('store');
    });

    Route::resource('/consumers', ConsumerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::resource('/products', ProductController::class);

    Route::controller(CartController::class)->group(function () {
        //cart
        Route::post('/add-to-cart', 'addToCart');
        // Route::get('/cart', 'cart')->name('cart');
        // Route::post('/update-cart', 'updateCart')->name('updateCart');
        // Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
        // Route::get('/destroy-cart', 'destroyCart')->name('destroyCart');
    
        // //coupon
        // Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
        // Route::get('/remove-coupon', 'removeCoupon')->name('removeCoupon');
    });
});

//backend
Route::prefix('/admin')->as('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminLoginController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AdminResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route::resource('/blogs', BlogController::class);

    //admin management
    // ->middleware('admin_user')
    Route::controller(AdminRegistrationController::class)->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/admin/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/admin/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');

    });
    Route::controller(BackendManagementController::class)->group(function () {

        Route::get('/customer-list', 'customerList')->name('customerList');
        Route::get('/user-list', 'userList')->name('userList');
    });

    //customer or user contact route
    Route::get('/contatc', [DashboardController::class, 'showContact'])->name('showContact');
    Route::post('/contact/update/{contact}', [DashboardController::class, 'updateContact'])->name('updateContact');
    Route::delete('/contact/delete/{contact}', [DashboardController::class, 'deleteContact'])->name('deleteContact');

    Route::controller(CompanyInfoController::class)->group(function () {
        Route::get('/company-info', 'showCompanyInfo')->name('showCompanyInfo');
        Route::post('/store-company-info', 'storeCompanyInfo')->name('storeCompanyInfo');
    });
    //pages
    Route::controller(PageController::class)->group(function () {
        Route::get('/pages', 'pageList')->name('pageList');
        Route::get('/create-pages', 'pageCreate')->name('pageCreate');
        Route::post('/store-pages', 'pageStore')->name('pageStore');
        Route::get('/edit-pages/{page}', 'pageEdit')->name('pageEdit');
        Route::put('/update-pages/{page}', 'pageUpdate')->name('pageUpdate');
        Route::delete('/delete-pages/{page}', 'pageDelete')->name('pageDelete');
        Route::post('/active-pages/{page}', 'pageActive')->name('pageActive');
        Route::post('/inactive-pages/{page}', 'pageInactive')->name('pageInactive');
    });
});

Route::get('/cc',[CartController::class,'cc']);