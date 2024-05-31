<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\MyShopController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class,'listItems']);
Route::get('/register', [PageController::class,'register']);
Route::post('/register', [DataController::class,'register']);
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [DataController::class, 'login']);
Route::post('/logout', [DataController::class, 'logout'])->middleware('auth');
Route::get('/startselling', [PageController::class,'startselling'])->middleware('auth');
Route::get('/sellerregistration', [PageController::class,'sellerregistration'])->middleware('auth');
Route::post('/sellerregistration', [ProductController::class,'startSelling'])->middleware('auth');
Route::get('/myShop', [MyShopController::class,'myShop'])->middleware(['auth', 'seller']);
Route::post('/addProduct', [ProductController::class,'addProduct'])->middleware(['auth', 'seller']);
Route::post('/deleteProduct', [ProductController::class,'deleteProduct'])->middleware(['auth', 'seller']);
Route::post('/editProduct', [ProductController::class,'editProduct'])->middleware(['auth', 'seller']);
Route::get('/productdetails/{id}', [ProductController::class,'productdetails'])->middleware('auth');
Route::post('/transaction/{id}', [ProductController::class,'transaction'])->middleware('auth');
Route::get('/viewshop/{id}', [PageController::class,'viewshop'])->middleware('auth');
Route::post('/addtocart/{id}', [ProductController::class,'addtocart'])->middleware('auth');
Route::get('/viewcart', [PageController::class, 'viewcart'])->middleware('auth');
Route::post('/updatecartitem/{id}', [PageController::class, 'updateCartItemQuantity'])->middleware('auth');
Route::delete('/removecartitem/{id}', [PageController::class, 'removeCartItem'])->middleware('auth');
Route::get('/checkout', [PageController::class, 'index'])->middleware('auth');