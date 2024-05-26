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
Route::get('/login', [PageController::class, 'login']);
Route::post('/login', [DataController::class, 'login']);
Route::post('/logout', [DataController::class, 'logout']);
Route::get('/startselling', [PageController::class,'startselling']);
Route::get('/sellerregistration', [PageController::class,'sellerregistration']);
Route::post('/sellerregistration', [ProductController::class,'startSelling']);
Route::get('/myShop', [MyShopController::class,'myShop']);
Route::post('/addProduct', [ProductController::class,'addProduct']);
Route::post('/deleteProduct', [ProductController::class,'deleteProduct']);
Route::post('/editProduct', [ProductController::class,'editProduct']);
Route::get('/productdetails/{id}', [ProductController::class,'productdetails']);
Route::post('/transaction/{id}', [ProductController::class,'transaction']);