<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\ProController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SlideController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/ca', function(){
    return view('admin.categories.cate_add');
});
Route::get('/trangchu', [PageController::class, 'getIndex'])->name('trangchu');
Route::get('/register', [PageController::class, 'getSignup'])->name('register');
Route::post('/postRegister', [PageController::class, 'postSignup'])->name('postSignup');

Route::get('/login', [PageController::class, 'getLogin'])->name('login');
Route::post('/postLogin', [PageController::class, 'postLogin'])->name('postSignin');

Route::prefix('admin')->group(function() {
    Route::middleware(['auth', RoleMiddleware::class. ':1'])->group(function(){
        Route::get('/catelist', [CateController::class, 'getListCate'])->name('getListCate');
        Route::get('/cateAddView', [CateController::class, 'getAddCate'])->name('getAddCate');
        Route::post('/cateAddpost', [CateController::class, 'postAddCate'])->name('postAddCate');
        Route::get('/cateEditView/{id}', [CateController::class, 'getEditCate'])->name('getEditCate');
        Route::put('/cateEditpost/{id}', [CateController::class, 'postEditCate'])->name('postEditCate');
        Route::get('/cateDel/{id}', [CateController::class, 'delCate'])->name('delCate');

        Route::get('/prolist', [ProController::class, 'getListPro'])->name('getListPro');
        Route::get('/proAddView', [ProController::class, 'getAddPro'])->name('getAddPro');
        Route::post('/proAddpost', [ProController::class, 'postAddPro'])->name('postAddPro');
        Route::get('/proEditView/{id}', [ProController::class, 'getEditPro'])->name('getEditPro');
        Route::put('/proEditpost/{id}', [ProController::class, 'postEditPro'])->name('postEditPro');
        Route::get('/proDel/{id}', [ProController::class, 'delPro'])->name('delPro');

        Route::get('/userlist', [UserController::class, 'getListUser'])->name('getListUser');
        Route::get('/userEditView/{id}', [UserController::class, 'getEditUser'])->name('getEditUser');
        Route::put('/userEditpost/{id}', [UserController::class, 'postEditUser'])->name('postEditUser');
        Route::get('/userDel/{id}', [UserController::class, 'delUser'])->name('delUser');

        Route::get('/getOrderList', [OrderController::class, 'getOrderList'])->name('getOrderList');
        Route::get('/getOrderListCompleted', [OrderController::class, 'getOrderListCompleted'])->name('getOrderListCompleted');
        Route::get('/getOrderListCancelled', [OrderController::class, 'getOrderListCancelled'])->name('getOrderListCancelled');
        Route::get('/getOrderListShipped', [OrderController::class, 'getOrderListShipped'])->name('getOrderListShipped');
        Route::get('/getOrderListPending', [OrderController::class, 'getOrderListPending'])->name('getOrderListPending');
        Route::get('/delOrder/{id}', [OrderController::class, 'delOrder'])->name('delOrder');
        Route::get('/getOrderDetails{id}', [OrderController::class, 'getOrderDetails'])->name('getOrderDetails');
        Route::put('/admin/orders/update-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
        Route::post('/admin/orders/update-status', [OrderController::class, 'updateStatus'])->name('updateStatusOd');


        Route::get('slides', [SlideController::class, 'index'])->name('admin.slides.index');
        Route::get('slides/create', [SlideController::class, 'create'])->name('admin.slides.create'); 
        Route::post('slides', [SlideController::class, 'store'])->name('admin.slides.store'); 
        Route::get('slides/{slide}', [SlideController::class, 'show'])->name('admin.slides.show'); 
        Route::get('slides/{slide}/edit', [SlideController::class, 'edit'])->name('admin.slides.edit');
        Route::put('slides/{slide}', [SlideController::class, 'update'])->name('admin.slides.update');
        Route::delete('slides/{slide}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');
    });
});


Route::middleware(['auth', RoleMiddleware::class. ':3'])->group(function(){
    Route::get('/getProfile', [UserController::class, 'getProfile'])->name('getProfile');
    Route::post('postProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/getCart', [CartController::class, 'getCart'])->name('getCart');
    Route::get('/cartCount', [CartController::class, 'getCartCount'])->name('getCartCount');
    Route::get('/delCartItem/{id}', [CartController::class, 'delCart'])->name('delCart');
    Route::post('/showOrder', [OrderController::class, 'showOrder'])->name('showOrder');
    Route::post('/postOrder', [OrderController::class, 'postOrder'])->name('postOrder');
    Route::put('/orders/cancel/{id}', [UserController::class, 'cancelOrder'])->name('cancelOrder');
    Route::post('/toggle-favorite', [FavoriteController::class, 'toggleFavorite'])->name('toggleFavorite')->middleware('auth');
    // Route::get('/getContact', [PageController::class, 'getContact'])->name('getContact');
});

Route::get('/search', [PageController::class, 'search'])->name('search');

Route::get('/pro_details/{id}', [ProController::class, 'getProDetails'])->name('getProDetails');


Route::get('/logout', [PageController::class, 'getLogout'])->name('logout');