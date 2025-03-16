<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-house-door-fill"></i> WebSec
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('even') }}">
                        <i class="bi bi-sort-numeric-up"></i> Even Numbers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prime') }}">
                        <i class="bi bi-patch-check"></i> Prime Numbers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('multable') }}">
                        <i class="bi bi-table"></i> Multiplication Table
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('products.index') }}">
                           <i class="bi bi-box-seam"></i> Products
                     </a>
                </li>
            </ul>

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary ms-3">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary ms-2">
                    <i class="bi bi-person-plus-fill"></i> Register
                </a>
            @else
                <div class="dropdown ms-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest

            <button id="darkModeToggle" class="btn btn-outline-dark ms-3">
                <i class="bi bi-moon-stars-fill"></i>
            </button>
        </div>
    </div>
</nav>


<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    darkModeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem('dark-mode', body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
    });
</script>

<style>
    body.dark-mode {
        background-color: #121212;
        color: white;
    }
    .dark-mode .navbar {
        background-color: #1f1f1f !important;
    }
    .dark-mode .nav-link, .dark-mode .navbar-brand {
        color: white !important;
    }
</style>
