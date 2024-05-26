@include('templates.header')

<x-navbar />

<section class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="https://via.placeholder.com/1200x200" class="img-fluid" alt="Shop Banner">
            </div>
        </div>
    </div>
</section>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#productsTable"
                        aria-expanded="false" aria-controls="productsTable">Manage Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage Shop</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="productsTable" class="collapse container">
    <div class="row my-3">
        <div class="col">
            <div class="input-group">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">Add Product</button>
                <input type="text" class="form-control ms-2" placeholder="Enter product name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->categoryName }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 50px;">
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$product->id}}">Edit</button>|
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationModal{{$product->id}}">Delete</button>
                                    </div>                        
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- cofirmation sa delete modal -->
@foreach ($products as $product)
@if(count($products) > 0)
    <div class="modal fade" id="confirmationModal{{$product->id}}" tabindex="-1" aria-labelledby="confirmationModalLabel{{$product->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel{{$product->id}}">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="/deleteProduct" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach

<!-- Modal para add product -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addProduct" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">                              
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select mb-3" id="productCategory" name="category" required>
                            <option selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter price" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity" placeholder="Enter quantity" required>
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" placeholder="Enter description" required></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" accept="image/*" required>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>           
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para edit product -->
@foreach ($products as $product)
@if(count($products) > 0)
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModal{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/editProduct" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">                              
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="name" value="{{$product->name}}" placeholder="Enter product name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Category</label>
                    <select class="form-select mb-3" id="productCategory" name="category" required>
                        <option selected disabled>Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" id="productPrice" name="price" value="{{$product->price}}" placeholder="Enter price" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productQuantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="productQuantity" name="quantity" value="{{$product->quantity}}" placeholder="Enter quantity" required>
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="productDescription" name="description" rows="3" placeholder="Enter description" required>{{$product->description}}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Select Image</label>
                    <input type="file" class="form-control" id="productImage" name="image" accept="image/*" required>
                    @if($product->image)
                        <div class="mt-2">Current Image: {{ $product->image }}</div>
                    @else
                        <div class="mt-2">No image uploaded</div>
                    @endif
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>    
                                
            </div>
            <div class="modal-footer">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit Product</button>           
            </div>
        </form>
      </div>
    </div>
  </div>
@endif
@endforeach

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($products as $product)
        <div class="col">
            <div class="card h-100 d-flex flex-column justify-content-between shopee-card">
                <a href="#" class="card-link d-block text-decoration-none">
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
        @endforeach
    </div>
</div>

@include('templates.footer')