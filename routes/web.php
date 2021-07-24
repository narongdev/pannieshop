<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\MaillistController;
use App\Http\Controllers\FrontController;

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

///////////////////// FRONT END ///////////////////////

Route::get('/', [FrontController::class,'homePage']);
Route::get('/catagory/{id}', [FrontController::class,'catagoryPage']);
Route::get('/products/{id}', [FrontController::class,'productPage']);

Route::get('/cart', [FrontController::class,'cartPage'])->name('cart');
Route::get('/clearcart', [FrontController::class,'clearcart']);
Route::get('/checkout', [FrontController::class,'checkoutPage'])->name('checkout');
Route::post('/billing', [FrontController::class,'billingInfo']);
Route::get('/thank', function(){ return view('frontend.thank'); })->name('thank');
Route::get('/register', function(){ return view('frontend.register'); })->name('register');
Route::post('/register', [FrontController::class,'register']);
Route::post('/information', [FrontController::class,'information']);
Route::get('/account', [FrontController::class,'account'])->name('account');
Route::post('/login', [FrontController::class,'login']);
Route::get('/logout', [FrontController::class,'logout']);

///////////////////// BACK END ///////////////////////

Route::get('/backend', function () { return view('backend.authen.login'); })->name('login');
Route::get('/login', function () { return view('backend.authen.login'); });
Route::get('/admin', function () { return view('backend.authen.login'); });

Route::get('/backend/login', function () { return view('backend.authen.login'); });
Route::get('/backend/admin', function () { return view('backend.authen.login'); });

Route::post('/backend/authen', [AuthController::class,'authen'])->name('authen');
Route::get('/backend/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware('check')->group(function(){

    Route::get('/backend/dashboard', function () { return view('backend.authen.dashboard'); })->name('dashboard');

    // User
    Route::get('/backend/user', [UserController::class,'index'])->name('user');
    Route::prefix('/backend/user')->group(function(){
        Route::get('/add', [UserController::class,'create'])->name('useradd');
        Route::post('/store', [UserController::class,'store'])->name('userstore');
        Route::get('/show/{id}', [UserController::class,'show'])->name('usershow');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('useredit');
        Route::post('/update/{id}', [UserController::class,'update'])->name('userupdate');
        Route::get('/delete/{id}', [UserController::class,'destroy'])->name('userdelete');
        Route::get('/type/{key}', [UserController::class,'filter']);
    });

    // Catagory
    Route::get('/backend/catagory', [CatagoryController::class,'index'])->name('catagory');
    Route::prefix('/backend/catagory')->group(function(){
        Route::get('/add', [CatagoryController::class,'create'])->name('catagoryadd');
        Route::post('/store', [CatagoryController::class,'store'])->name('catagorystore');
        Route::get('/show/{id}', [CatagoryController::class,'show'])->name('catagoryshow');
        Route::get('/edit/{id}', [CatagoryController::class,'edit'])->name('catagoryedit');
        Route::post('/update/{id}', [CatagoryController::class,'update'])->name('catagoryupdate');
        Route::get('/delete/{id}', [CatagoryController::class,'destroy'])->name('catagorydelete');
        Route::get('/recommend/{key}', [CatagoryController::class,'filter']);
    });

    // Products
    Route::get('/backend/products', [ProductController::class,'index'])->name('products');
    Route::prefix('/backend/products')->group(function(){
        Route::get('/add', [ProductController::class,'create'])->name('productsadd');
        Route::post('/store', [ProductController::class,'store'])->name('productsstore');
        Route::get('/show/{id}', [ProductController::class,'show'])->name('productsshow');
        Route::get('/edit/{id}', [ProductController::class,'edit'])->name('productsedit');
        Route::post('/update/{id}', [ProductController::class,'update'])->name('productsupdate');
        Route::get('/delete/{id}', [ProductController::class,'destroy'])->name('productsdelete');
        Route::get('/recommend/{key}', [ProductController::class,'filter']);
        Route::get('/catagory/{key}', [ProductController::class,'filtercat']);
    });

    // Member
    Route::get('/backend/member', [MemberController::class,'index'])->name('member');
    Route::prefix('/backend/member')->group(function(){
        Route::get('/add', [MemberController::class,'create'])->name('memberadd');
        Route::post('/store', [MemberController::class,'store'])->name('memberstore');
        Route::get('/show/{id}', [MemberController::class,'show'])->name('membershow');
        Route::get('/edit/{id}', [MemberController::class,'edit'])->name('memberedit');
        Route::post('/update/{id}', [MemberController::class,'update'])->name('memberupdate');
        Route::get('/delete/{id}', [MemberController::class,'destroy'])->name('memberdelete');
        Route::get('/search/{key}', [MemberController::class,'search']);
    });

    // Order
    Route::get('/backend/order', [OrderController::class,'index'])->name('order');
    Route::prefix('/backend/order')->group(function(){
        Route::get('/add', [OrderController::class,'create'])->name('orderadd');
        Route::post('/store', [OrderController::class,'store'])->name('orderstore');
        Route::get('/show/{id}', [OrderController::class,'show'])->name('ordershow');
        Route::get('/edit/{id}', [OrderController::class,'edit'])->name('orderedit');
        Route::post('/update/{id}', [OrderController::class,'update'])->name('orderupdate');
        Route::get('/delete/{id}', [OrderController::class,'destroy'])->name('orderdelete');
        Route::get('/search/{key}', [OrderController::class,'search']);
    });

    // Promotion
    Route::get('/backend/promotion', [PromotionController::class,'index'])->name('promotion');
    Route::prefix('/backend/promotion')->group(function(){
        Route::get('/add', [PromotionController::class,'create'])->name('promotionadd');
        Route::post('/store', [PromotionController::class,'store'])->name('promotionstore');
        Route::get('/show/{id}', [PromotionController::class,'show'])->name('promotionshow');
        Route::get('/edit/{id}', [PromotionController::class,'edit'])->name('promotionedit');
        Route::post('/update/{id}', [PromotionController::class,'update'])->name('promotionupdate');
        Route::get('/delete/{id}', [PromotionController::class,'destroy'])->name('promotiondelete');
        Route::get('/search/{key}', [PromotionController::class,'search']);
    });

    // Maillist
    Route::get('/backend/maillist', [MaillistController::class,'index'])->name('maillist');
    Route::prefix('/backend/maillist')->group(function(){
        Route::get('/add', [MaillistController::class,'create'])->name('maillistadd');
        Route::post('/store', [MaillistController::class,'store'])->name('mailliststore');
        Route::get('/edit/{id}', [MaillistController::class,'edit'])->name('maillistedit');
        Route::post('/update/{id}', [MaillistController::class,'update'])->name('maillistupdate');
        Route::get('/delete/{id}', [MaillistController::class,'destroy'])->name('maillistdelete');
        Route::get('/search/{key}', [MaillistController::class,'search']);
    });

});
