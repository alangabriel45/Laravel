@include('templates.header')

<x-navbar />

<section class="py-4">
    <div class="container text-center">
        <img src="{{ URL('images/' . $shop->shopImage) }}" class="rounded-circle" alt="Profile Picture" width="150">
        <h1 class="mt-3">{{$shop->shopName}}</h1>

</section>

<section class="py-4">
    <div class="container">
        <h2 class="text-center">Products</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach($products as $product)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text text-primary">${{ $product->price }}</p>
                        <a href="#" class="btn btn-primary" style="background-color: blue;">Add to Cart</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-light py-4">
    <div class="container">
        <h2 class="text-center">About Us</h2>
        <p class="text-center">Welcome to <strong>{{$shop->shopName}}</strong>! We offer a wide range of high-quality products to meet all your needs. Enjoy browsing through our collection and don't hesitate to contact us for any queries.</p>
    </div>
</section>

@include('templates.footer')