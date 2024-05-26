<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyShopController extends Controller
{
    public function myShop()
    {
        $user = Auth::user();

        $shop = Shop::where('userId', $user->id)->first();

        if ($shop) {

            $shopId = $shop->id;

            $categories = Category::all();

            $products = Product::where('shopId', $shopId)->get();

            return view('myShop', compact('categories', 'products'));
        } 
        else 
        {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }
    }

}
