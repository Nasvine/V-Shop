<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\User\ProductListController;

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

//Users Routes

Route::get('/', [UserController::class, 'index'])->name('user.home');

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', [DashboardController::class, 'about'])->name('user.about');
Route::get('/contact', [DashboardController::class, 'contact_index'])->name('user.contact.index');
Route::post('/contact/store', [DashboardController::class, 'contact_store'])->name('user.contact.store');

Route::middleware('auth')->group(function () {  


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //chekcout 
    Route::prefix('checkout')->controller(CheckoutController::class)->group((function()  {
        Route::post('order','store')->name('checkout.store');
        Route::get('success','success')->name('checkout.success');
        Route::get('cancel','cancel')->name('checkout.cancel');
    }));
});


// Admin Routes

Route::group(['prefix' => 'admin', 'middleware' => 'redirectAdmin'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    // Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});


//add to cart 

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('view','view')->name('cart.view');
    Route::post('store/{product}','store')->name('cart.store');
    Route::patch('update/{product}','update')->name('cart.update');
    Route::delete('delete/{product}','delete')->name('cart.delete');
});


//routes for products list and filter 
Route::prefix('products')->controller(ProductListController::class)->group(function ()  {
    Route::get('/','index')->name('products.index');
    
});





Route::middleware('auth', 'admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        //products routes 
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
        Route::put('/products/update/{id}',[ProductController::class,'update'])->name('admin.products.update');
        Route::delete('/products/image/{id}',[ProductController::class,'deleteImage'])->name('admin.products.image.delete');
        Route::delete('/products/destory/{id}',[ProductController::class,'destory'])->name('admin.products.destory');
});



require __DIR__.'/auth.php';
