@php
    $userId = Auth::id();
    $userRoles = \App\Models\MultiRole::where('userId', $userId)->pluck('roleName')->toArray();
@endphp
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-xxl">
        <a href="/" class="navbar-brand">
            <span class="fw-bold text-secondary">
                E-Commerce
            </span>
        </a>
        <!-- toggle button for mobile nav -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-end align-items-start overlay" id="main-nav">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item d-md-none">
                        <a href="#" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item d-md-none">
                        @if(!(in_array('1', $userRoles) && in_array('2', $userRoles)))
                            <a href="/startselling" class="nav-link">Start Selling</a>
                        @else
                            <li class="nav-item d-md-none">
                                <a href="/myShop" class="nav-link">My Shop</a>
                            </li>
                        @endif
                    </li>                   
                    <li class="nav-item d-md-none">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>                   
                    </li>
                    <li class="nav-item dropdown d-none d-md-inline">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ URL('images/OIP.jpg') }}" alt="Profile Picture" class="rounded-circle" style="width: 32px; height: 32px;">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @if((in_array('1', $userRoles) && in_array('2', $userRoles)))
                                <li><a class="dropdown-item" href="/myShop">My Shop</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @else
                            <li><a class="dropdown-item" href="/startselling">Start Selling</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-md-none">
                        <a href="/login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a href="/register" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item d-none d-md-inline me-1">
                        <a href="/login" class="btn btn-primary">Login</a>
                    </li>
                    <li class="nav-item d-none d-md-inline">
                        <a href="/register" class="btn btn-primary">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>