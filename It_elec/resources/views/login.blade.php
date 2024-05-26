@include('templates.header')

<x-navbar />

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 border border-secondary rounded p-4">
            <form action="/login" method="post">
                <h2 class="text-center mb-4">Login</h2>
                <div class="mb-3">
                    @csrf
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="mt-3 text-center">
                    <a href="#">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</div>


@include('templates.footer')