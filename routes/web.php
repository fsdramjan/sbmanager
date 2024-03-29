<?php

use App\Http\Controllers\Backend\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Auth\AdminRegistrationController;
use App\Http\Controllers\Backend\Auth\AdminResetPasswordController;
use App\Http\Controllers\Backend\Auth\BackendManagementController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Customer\Auth\CustomerForgotPasswordController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\Auth\CustomerRegisterController;
use App\Http\Controllers\Customer\Auth\CustomerResetPasswordController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ConsumerController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DueController;
use App\Http\Controllers\Customer\EmployeeController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\QuickSellController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\SupplierController;
use App\Http\Controllers\Customer\TransactionController;
use Gloudemans\Shoppingcart\Facades\Cart;
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
    return dd(session()->get('order'));
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
        Route::post('/add-to-cart/discount', 'extraDiscount');
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/cart/{order_id}', 'cartOrder')->name('cartOrder');
        Route::post('/update-cart', 'updateCart')->name('updateCart');
        Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
        Route::get('destroy', function () {
            Cart::destroy();

            return redirect()->route('customer.cart');
        });
    });

    Route::controller(QuickSellController::class)->prefix('/quicksell')->group(function () {
        Route::get('/', 'quicksell')->name('quicksell');
        Route::post('/store', 'storeQuicksell')->name('storeQuicksell');
        Route::get('/edit/{order_id}', 'editQuicksell')->name('editQuicksell');
        Route::post('/update/{order_id}', 'updateQuicksell')->name('updateQuicksell');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::post('/placeOrder', 'placeOrder')->name('placeOrder');
    });
    Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
        Route::get('/', 'transaction')->name('transaction');
        Route::get('/details/{id}', 'transactionDetails')->name('transactionDetails');
    });

    Route::controller(DueController::class)->prefix('/due')->as('due.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/due-or-deposit/{id}/{text}', 'showDueDeposit')->name('showDueDeposit');
        Route::post('/store/due-or-deposit', 'storeDueDeposit')->name('storeDueDeposit');
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

Route::get('/cc', [CartController::class, 'cc']);
Route::get('/get-category/{category}', [DueController::class, 'category']);