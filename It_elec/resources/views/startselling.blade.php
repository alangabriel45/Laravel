@include('templates.header')

<x-navbar />

<h1>StartSelling</h1>

<div class="container bg-light py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 text-center">
            <img src="{{ URL('images/images.png') }}" alt="Fill up a form" class="rounded-circle img-fluid mb-4" style="max-width: 200px;">
            <h2 class="mb-4">Start Selling on Our Platform</h2>
            <p class="mb-4">Ready to grow your business? Join our platform and start selling your products today!</p>
            <a href="/sellerregistration" class="btn btn-primary btn-lg">Start Registration</a>
        </div>
    </div>
</div>



@include('templates.footer')
