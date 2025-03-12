<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Film Review - Trusted film review platform">
    <title>@yield('title') - FilmKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <style>
        :root {
            --primary: #4285F4; 
            --primary-dark: #1A73E8; 
            --blue-light: #D2E3FC;
            --blue-bg: #E8F0FE;
            --secondary: #14b8a6;
            --dark: #1e293b; 
            --light: #f8fafc;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); 
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1); 
        }

        body {
            background-color: var(--light);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--dark);
        }

        .navbar {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            transition: var(--transition);
        }

        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important; 
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
        }

        .nav-link:hover {
            background-color: rgba(66, 133, 244, 0.1); 
            color: var(--primary) !important;
        }

        .dropdown-menu {
            border: none;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: var(--shadow-lg);
            border-radius: 1rem;
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background-color: rgba(66, 133, 244, 0.1);
            color: var(--primary);
        }

        .content-wrapper {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 1rem;
            background-color: white;
            box-shadow: var(--shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary); 
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark); 
            border-color: var(--primary-dark);
        }

        .footer {
            background-color: white;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem 0;
            margin-top: auto;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background-color: rgba(66, 133, 244, 0.1); 
            color: var(--primary); 
            transition: var(--transition);
        }

        .social-link:hover {
            background-color: var(--primary); 
            color: white;
            transform: translateY(-3px);
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .nav-link {
                padding: 0.5rem;
            }

            .social-link {
                width: 2rem;
                height: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="content-wrapper">
        <div>
            @yield('content')
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const navbar = document.querySelector('.navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });

        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('show.bs.dropdown', function() {
                const menu = this.querySelector('.dropdown-menu');
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    menu.style.transition = 'all 0.2s ease-out';
                    menu.style.opacity = '1';
                    menu.style.transform = 'translateY(0)';
                }, 0);
            });

            dropdown.addEventListener('hide.bs.dropdown', function() {
                const menu = this.querySelector('.dropdown-menu');
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(-10px)';
            });
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>