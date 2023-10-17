<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

// for login , register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // admin
    Route::middleware(['admin_auth'])->group(function(){
        // category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        // admin account
        Route::prefix('admin')->group(function(){
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');
            Route::get('detail',[AdminController::class,'detail'])->name('admin#detail');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
        });

        // products List
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        // order List
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        // user list
        Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            Route::get('changeRole',[UserController::class,'userChangeRole'])->name('admin#userChangeRole');
            Route::get('deleteUser/{id}',[UserController::class,'deleteUser'])->name('admin#userDelete');
            Route::get('editUser/{id}',[UserController::class,'editUser'])->name('admin#userEdit');
            Route::post('update/{id}',[UserController::class,'updateUser'])->name('admin#userUpdate');
        });

        // contact message
        Route::prefix('contact')->group(function(){
            Route::get('messageList',[ContactController::class,'messageList'])->name('user#MessageList');
            Route::get('delete/{id}',[ContactController::class,'deleteContact'])->name('user#deleteContact');
        });
    });



    // user
    // home
    Route::group(['prefix' => 'user','middleware'=>'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        // password
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        // account
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        // ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('cart/clear',[AjaxController::class,'clear'])->name('ajax#clear');
            Route::get('cart/current/clear',[AjaxController::class,'currentCartClear'])->name('ajax#currentCartClear');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        // pizza detail
        Route::prefix('pizza')->group(function(){
            Route::get('detail/{id}',[UserController::class,'detail'])->name('user#pizzaDetail');
        });

        //cart list
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });

        // contact
        Route::prefix('contact')->group(function(){
            Route::get('detail',[ContactController::class,'contact'])->name('user#contact');
            Route::post('sent',[ContactController::class,'sentMessage'])->name('user#sentMessage');
        });
    });

});


