<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FavoriteController;

Route::get('/',  [WebController::class, 'index'])->name('top');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/delete', 'delete')->name('users.delete');
    Route::delete('users/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/favorite', 'favorite')->name('users.favorite');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.store');

Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/store/{store}', [StoreController::class, 'show'])->name('stores.show');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');
Route::post('items/', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/follow', [ItemController::class, 'follow'])->name('items.follow');
Route::get('/item/{item}/chart', [ItemController::class, 'chart'])->name('items.chart');
Route::get('/item/{item}/graph', [ItemController::class, 'batch'])->name('items.batch');

Route::post('follows/{item_id}', [FollowController::class, 'store'])->name('follows.store');
Route::delete('follows/{item_id}', [FollowController::class, 'destroy'])->name('follows.destroy');

Route::post('favorites/{post_id}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('favorites/{post_id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');

    Route::get('users/index', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/show/{user}', [Admin\UserController::class, 'show'])->name('users.show');
    Route::delete('users/delete', [Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('stores/index', [Admin\StoreController::class, 'index'])->name('stores.index');
    Route::get('stores/show/{store}', [Admin\StoreController::class, 'show'])->name('stores.show');
    Route::get('stores/create', [Admin\StoreController::class, 'create'])->name('stores.create');
    Route::post('stores/index', [Admin\StoreController::class, 'store'])->name('stores.store');
    Route::get('stores/edit/{store}', [Admin\StoreController::class, 'edit'])->name('stores.edit');
    Route::patch('stores/show/{store}', [Admin\StoreController::class, 'update'])->name('stores.update');
    Route::get('stores/delete', [Admin\StoreController::class, 'delete'])->name('stores.delete');
    Route::delete('stores/delete', [Admin\StoreController::class, 'destroy'])->name('stores.destroy');

    Route::get('items/index', [Admin\ItemController::class, 'index'])->name('items.index');
    Route::post('items/index', [Admin\ItemController::class, 'store'])->name('items.store');
    Route::get('/items/edit/{item}', [Admin\ItemController::class, 'edit'])->name('items.edit');
    Route::patch('/items/index/{item}', [Admin\ItemController::class, 'update'])->name('items.update');
    Route::delete('items/index/{item}', [Admin\ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('posts/index', [Admin\PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/edit/{post}', [Admin\PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/index/{post}', [Admin\PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/index/{post}', [Admin\PostController::class, 'destroy'])->name('posts.destroy');

});
