@include('templates.header')

<x-navbar />

<form action="/register" method="post">
    @csrf
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('lastname') border border-danger @enderror" id="lastname" name="lastname" placeholder="Enter last name">
                        @error('lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('firstname') border border-danger @enderror" id="firstname" name="firstname" placeholder="Enter first name">
                        @error('firstname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') border border-danger @enderror" id="email" name="email" placeholder="Enter email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') border border-danger @enderror" id="password" name="password" placeholder="Enter password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') border border-danger @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button> 
                </div>
                <div class="card-footer text-muted">
                    Hello World!
                </div>
            </div>
        </div>
    </div>        
</form>

@include('templates.footer')
