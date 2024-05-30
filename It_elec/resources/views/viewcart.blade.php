@include('templates.header')

<x-navbar />

<div class="container my-5">
    <h1 class="mb-4">Your Cart</h1>

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors')->first() }}
        </div>
    @endif

    <div id="cartContent" @if($cartItems->isEmpty()) style="display: none;" @endif>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <div class="input-group" style="max-width: 120px;">
                                <button class="btn btn-outline-primary" type="button" onclick="updateCartItemQuantity({{ $item->id }}, -1)">-</button>
                                <input type="text" class="form-control text-center" value="{{ $item->quantity }}" readonly>
                                <button class="btn btn-outline-primary" type="button" onclick="updateCartItemQuantity({{ $item->id }}, 1)">+</button>
                            </div>
                        </td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="/removecartitem/{{ $item->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="emptyCartMessage" @if(!$cartItems->isEmpty()) style="display: none;" @endif>
        <div class="alert alert-info">
            Your cart is empty.
        </div>
    </div>
</div>

@include('templates.footer')

<script src="{{ asset('js/product.js') }}"></script>