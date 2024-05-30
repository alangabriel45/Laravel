@include('templates.header')

<x-navbar />

<div class="container my-5">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-5 d-flex align-items-center justify-content-center">
            <img src="{{ URL('products/' . $product->image) }}" class="img-fluid rounded" alt="Product Image" style="max-width: 100%; height: 300px;">
        </div>
        <!-- Product Details Section -->
        <div class="col-md-7">
            <h1 class="fw-bold">{{ $product->name }}</h1>
            <p class="lead">{{ $product->description }}</p>
            <h2 class="text-primary">${{ $product->price }}</h2>
            <!-- Quantity Selector -->
            <div class="input-group mb-3" style="max-width: 200px;">
                <button class="btn btn-outline-primary" type="button" onclick="decrementQuantity({{ $product->id }}, {{ $product->price }})">-</button>
                <input type="text" class="form-control text-center" id="quantity{{ $product->id }}" value="1" style="font-size: 14px;" readonly>
                <button class="btn btn-outline-primary" type="button" onclick="incrementQuantity({{ $product->id }}, {{ $product->quantity }}, {{ $product->price }})">+</button>
            </div>
            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <form action="/addtocart/{{$product->id}}" method="post">
                    @csrf
                    <input type="hidden" name="quantity" id="quantityInput{{ $product->id }}" value="1">
                    <button class="btn btn-outline-primary flex-fill" type="submit">Add to Cart</button>
                </form>
                <button class="btn btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="updateModal({{ $product->id }}, {{ $product->price }})">Buy Now</button>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row bg-light p-4 rounded">
        <!-- Shop Details Section -->
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <img src="{{ URL('images/' . $shop->shopImage) }}" class="img-fluid rounded-circle" alt="Shop Image" style="max-width: 100px; height: 100px;">
        </div>
        <div class="col-md-9">
            <h5 class="fw-bold">{{ $shop->shopName }}</h5>
            <p class="mb-0">{{ $shop->shopDesc }}</p>
            <div class="d-flex gap-2 mt-2">
                <button class="btn btn-outline-primary flex-fill">Chat Now</button>
                <a href="/viewshop/{{ $shop->id }}" class="btn btn-outline-primary flex-fill">View Shop</a>
            </div>
            {{-- <div class="d-flex mt-3">
                <div class="me-5">
                    <strong>Ratings:</strong> 708.9K
                </div>
                <div class="me-5">
                    <strong>Products:</strong> 460
                </div>
                <div class="me-5">
                    <strong>Response Rate:</strong> 100%
                </div>
                <div class="me-5">
                    <strong>Response Time:</strong> within hours
                </div>
                <div>
                    <strong>Followers:</strong> 145.5K
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/transaction/{{ $product->id }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Quantity: <span id="quantitySpan">1</span></p>
                    <p>Total Price: $<span id="totalPrice">{{ $product->price }}</span></p>
                    <input type="hidden" name="quantity" id="modalQuantity" value="1">
                    <input type="hidden" name="totalPrice" id="modalTotalPrice" value="{{ $product->price }}">
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment</label>
                        <input type="text" name="payment" class="form-control" placeholder="Enter payment details" required>
                    </div>
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

<script src="{{ asset('js/product.js') }}"></script>