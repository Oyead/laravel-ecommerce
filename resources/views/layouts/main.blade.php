<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sixteen Clothing</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="{{ asset('User/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('User/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('User/assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('User/assets/css/owl.css') }}">
</head>
<body>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><h2>Sixteen <em>Clothing</em></h2></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Our Products</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
    </li>

@if (Route::has('login'))
    @auth
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
        </li>
        <li class="nav-item">
    <a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist</a>
</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </a>
            </form>
        </li>
        
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Log in</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @endif
    @endauth
@endif
</ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; 2025 Sixteen Clothing Co., Ltd.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('User/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('User/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('User/assets/js/custom.js') }}"></script>
    <script src="{{ asset('User/assets/js/owl.js') }}"></script>
    <script src="{{ asset('User/assets/js/slick.js') }}"></script>
    <script src="{{ asset('User/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('User/assets/js/accordions.js') }}"></script>
</body>
</html>