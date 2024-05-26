@include('templates.header')

<x-navbar />

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Seller Onboarding Form - Step 1</div>
        <div class="card-body">
          <form action="/sellerregistration" method="post" enctype="multipart/form-data">
              @csrf
            <div class="mb-3">
              <label for="shopImage" class="form-label">Shop Profile Image</label>
              <input type="file" class="form-control @error('shopImage') is-invalid @enderror" id="shopImage" name="shopImage">
              @error('shopImage')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="shopName" class="form-label">Shop Name</label>
              <input type="text" class="form-control @error('shopName') is-invalid @enderror" id="shopName" name="shopName" placeholder="Enter your shop name">
              @error('shopName')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email address">
              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="mobileNumber" class="form-label">Mobile Number</label>
              <input type="tel" class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number">
              @error('mobileNumber')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
            </div>
            <div class="mb-3">
              <label for="shopDesc" class="form-label">Shop Description</label>
              <textarea class="form-control @error('shopDesc') is-invalid @enderror" id="shopDesc" name="shopDesc" rows="3" placeholder="Enter a brief description of your shop"></textarea>
              @error('shopDesc')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <!-- Add more form fields as needed -->
            <button type="submit" class="btn btn-primary">Next</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@include('templates.footer')
