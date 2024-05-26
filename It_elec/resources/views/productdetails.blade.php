@include('templates.header')

<x-navbar />

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ URL('products/' .$product->image) }}" class="img-fluid" alt="Product Image" style="width: 500px; height: 300px;">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold">{{$product->name}}</h1>
            <p class="lead">{{$product->description}}</p>
            <h2 class="text-primary">${{$product->price}}</h2>
            <div class="input-group mb-3">
                <button class="btn btn-primary" type="button" onclick="decrementQuantity({{$product->id}})">-</button>
                <span class="input-group-text" id="quantity{{$product->id}}" style="font-size: 14px;">1</span>
                <button class="btn btn-primary" type="button" onclick="incrementQuantity({{$product->id}}, {{$product->quantity}})">+</button>
            </div>
            <button class="btn btn-primary mt-3">Add to Cart</button>
            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Buy Now</button>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row me-5">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ URL('images/' . $shop->shopImage) }}" class="img-fluid" alt="Product Image" style="width: 300px; height: 150px;">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold">{{$shop->shopName}}</h1>
            <p class="lead">{{$shop->shopDesc}}</p>
            <button class="btn btn-success mt-3">View Shop</button>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/transaction/{{$product->id}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">             
                    <p>Quantity: <span id="quantitySpan">{{ $product->quantity }}</span></p>
                    <input type="hidden" name="quantity" id="modalQuantity" value="{{ $product->quantity }}">
                    <input type="text" name="payment" class="form form-control" placeholder="Payment">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('templates.footer')