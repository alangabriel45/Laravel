<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MultiRole;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function listItems()
    {
        $products = Product::all();
        return view('index')->with('products', $products);
    }
    public function startSelling(Request $request)
    {
        // Get the authenticated user's ID   

    // Validate the incoming request data
    $data = $request->validate([
        'shopName' => 'required|string',
        'email' => 'required|email',
        'mobileNumber' => 'required|string',
        'shopDesc' => 'required|string',
        'shopImage' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust image validation rules as needed
    ]);

    // Handle file upload
    if ($request->hasFile('shopImage')) {
        $image = $request->file('shopImage');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
    }
    $userId = Auth::id();
    // Create a new Shop instance
    Shop::create([
        'userId' => $userId,
        'shopName' => $data['shopName'],
        'email' => $data['email'],
        'mobileNumber' => $data['mobileNumber'],
        'shopDesc' => $data['shopDesc'],
        'shopImage' => $imageName,
        'status' => 1
    ]);
    
    MultiRole::create([
        'userId' => $userId,
        'roleName' => 2,
    ]);

    return redirect('/');
    }
    
    public function addProduct(Request $request)
    {
        $userId = Auth::id();
        $shop = Shop::where('userId', $userId)->first();

        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|integer',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = null; // Initialize imageName variable

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension(); // Use getClientOriginalExtension() to get extension
            $image->move(public_path('products'), $imageName);
        }

        // Check if shop exists and then create the product
        if ($shop) {
            $product = new Product([
                'name' => $data['name'],
                'categoryId' => $data['category'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'description' => $data['description'],
                'image' => $imageName,
                'shopId' => $shop->id,
            ]);

            $product->save();

            return redirect('/myShop')->with('success', 'Product added successfully!');
        }

        return redirect('/myShop')->with('error', 'Shop not found!');
    }
    public function deleteProduct(Request $request): RedirectResponse
    {
        $productId = $request->input('product_id');

        $product = Product::find($productId);

        if ($product) {

            $product->delete();
            return Redirect::back()->with('success', 'Product deleted successfully!');
        } else {

            return Redirect::back()->with('error', 'Product not found!');
        }
    }

    public function editProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'nullable|integer',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $productId = $request->input('product_id');

        $product = Product::find($productId);

        if ($product) {
            $product->name = $data['name'];
            
            if ($request->has('category')) {
                $product->categoryId = $data['category'];
            }

            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->description = $data['description'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('products'), $imageName);
                $product->image = $imageName;
            }

            $product->save();

            return Redirect::back()->with('success', 'Product updated successfully!');
        } else {
            return Redirect::back()->with('error', 'Product not found!');
        }
    }
    
    public function productdetails($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            // Assuming you have defined the 'shop' relationship in your Product model
            $shop = $product->shop;

            if ($shop) {
                return view('productdetails', compact('product', 'shop'));
            } else {
                return redirect()->back()->with('error', 'Shop details not found for the product');
            }
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    public function transaction(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'payment' => 'required|numeric|min:0', // Assuming payment should be numeric and non-negative
        ]);

        // Retrieve the payment amount from the request
        $payment = $request->input('payment');

        // Retrieve the quantity from the modal
        $quantity = $request->input('quantity');

        // Get the product by its ID
        $product = Product::findOrFail($id);

        // Perform necessary actions with the transaction and product data
        // For example, creating a new transaction record and updating product quantity
        Transaction::create([
            'userId' => Auth::id(),
            'productId' => $id,
            'quantity' => $quantity, // Use the quantity from the modal
            'payment' => $payment,
        ]);

        // Update the product quantity
        $product->quantity -= $quantity;
        $product->save();

        // Redirect or return a response
        return redirect('/');
    }
}
