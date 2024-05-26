@include('templates.header')

<x-navbar />

<div class="container my-3">
    <hr>
    <h3>T-Shirts</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($products as $product)
        @if($product->categoryId == 1)
        <div class="col">
            <div class="card h-100 d-flex flex-column justify-content-between shopee-card">
                <a href="/productdetails/{{$product->id}}" class="card-link d-block text-decoration-none">
                    <img src="{{ URL('products/' . $product->image) }}" class="card-img-top shopee-product-image" alt="..." style="width: 100%; height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title text-dark shopee-product-title">{{$product->name}}</h5>
                        <p class="card-text text-muted shopee-product-description">{{$product->description}}</p>
                    </div>
                </a>
                <div class="card-footer bg-transparent border-top-0 shopee-product-footer">
                    <h5 class="card-text text-primary">{{$product->price}}</h5>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <hr>
</div>
<div class="container my-3">
    <hr>
    <h3>Pants</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($products as $product)
        @if($product->categoryId == 2)
        <div class="col">
            <div class="card h-100 d-flex flex-column justify-content-between shopee-card">
                <a href="/productdetails/{{$product->id}}" class="card-link d-block text-decoration-none">
                    <img src="{{ URL('products/' . $product->image) }}" class="card-img-top shopee-product-image" alt="..." style="width: 100%; height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title text-dark shopee-product-title">{{$product->name}}</h5>
                        <p class="card-text text-muted shopee-product-description">{{$product->description}}</p>
                    </div>
                </a>
                <div class="card-footer bg-transparent border-top-0 shopee-product-footer">
                    <h5 class="card-text text-primary">{{$product->price}}</h5>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <hr>
</div>
<div class="container my-3">
    <hr>
    <h3>Bag</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($products as $product)
        @if($product->categoryId == 3)
        <div class="col">
            <div class="card h-100 d-flex flex-column justify-content-between shopee-card">
                <a href="/productdetails/{{$product->id}}" class="card-link d-block text-decoration-none">
                    <img src="{{ URL('products/' . $product->image) }}" class="card-img-top shopee-product-image" alt="..." style="width: 100%; height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title text-dark shopee-product-title">{{$product->name}}</h5>
                        <p class="card-text text-muted shopee-product-description">{{$product->description}}</p>
                    </div>
                </a>
                <div class="card-footer bg-transparent border-top-0 shopee-product-footer">
                    <h5 class="card-text text-primary">{{$product->price}}</h5>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <hr>
</div>

@include('templates.footer')