<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="bi bi-film"></i> <span class="brand-text">ElMovie</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door"></i> <span class="nav-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('genres.*') ? 'active' : '' }}" href="{{ route('genres.index') }}">
                        <i class="bi bi-grid"></i> <span class="nav-text">Genres</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('films.*') ? 'active' : '' }}" href="{{ route('films.index') }}">
                        <i class="bi bi-film"></i> <span class="nav-text">Films</span>
                    </a>
                </li>
                
                @guest
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-outline-login px-3" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link btn-register px-3" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle user-dropdown d-flex align-items-center" href="#" 
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-gear me-2"></i> Edit Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2 text-danger" href="#" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        padding: 15px 0;
    }
    
    .navbar.scrolled {
        padding: 10px 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }
    
    .navbar-brand {
        color: #1a237e;
        font-size: 1.6rem;
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover {
        color: #3949ab;
    }
    
    .brand-text {
        font-weight: 700;
        letter-spacing: -0.5px;
    }
    
    .nav-link {
        color: #37474f;
        font-weight: 500;
        margin: 0 5px;
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .nav-link:hover {
        color: #1a237e;
        background-color: rgba(26, 35, 126, 0.05);
    }
    
    .nav-link.active {
        color: #1a237e;
        background-color: rgba(26, 35, 126, 0.08);
    }
    
    .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 15%;
        width: 70%;
        height: 3px;
        background-color: #4285F4;
        border-radius: 10px;
    }
    
    .btn-outline-login {
        border: 1px solid #4285F4;
        color: #3949ab;
        border-radius: 6px;
    }
    
    .btn-outline-login:hover {
        background-color: rgba(57, 73, 171, 0.1);
    }
    
    .btn-register {
        background-color: #4285F4;
        color: white !important;
        border-radius: 6px;
    }
    
    .btn-register:hover {
        background-color: #3949ab;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(26, 35, 126, 0.2);
    }
    
    .user-dropdown {
        padding: 8px 15px;
        border-radius: 30px;
        background-color: rgba(26, 35, 126, 0.08);
        color: #1a237e;
    }
    
    .dropdown-menu {
        border-radius: 8px;
        border: none;
        padding: 8px 0;
    }
    
    .dropdown-item {
        padding: 8px 20px;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover {
        background-color: rgba(26, 35, 126, 0.05);
    }
    
    .dropdown-item.text-danger:hover {
        background-color: rgba(244, 67, 54, 0.05);
    }
    
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            padding: 12px 15px;
            margin: 3px 0;
        }
        
        .btn-outline-login, .btn-register {
            display: block;
            text-align: center;
            margin: 5px 0;
        }
    }
    
    @media (min-width: 992px) {
        .navbar.scrolled .navbar-brand {
            font-size: 1.4rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    });
</script>