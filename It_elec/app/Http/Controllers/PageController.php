<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function startselling()
    {
        return view('startselling');
    }
    public function sellerregistration()
    {
        return view('sellerregistration');
    }
    public function viewshop($id)
    {
        $shop = Shop::find($id);

        if ($shop) {
            $products = Product::where('shopId', $shop->id)->get();

            return view('viewshop', compact('shop', 'products'));
        } else {
            return redirect()->back()->withErrors(['error' => 'Could not find shop']);
        }
    }
    public function viewcart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('userId', $userId)->with('product')->get();

        return view('viewcart', compact('cartItems'));
    }
    public function updateCartItemQuantity(Request $request, $id)
    {
        $cartItem = Cart::find($id);
        $change = $request->input('change');
        $newQuantity = $cartItem->quantity + $change;

        if ($newQuantity > 0) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function removeCartItem($id)
    {
        $cartItem = Cart::find($id);
        $cartItem->delete();
        return redirect()->route('viewcart');
    }
}
