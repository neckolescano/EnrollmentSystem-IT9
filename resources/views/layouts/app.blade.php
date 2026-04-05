<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>UM Enrollment System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Monoton&family=Orbitron:wght@400;700&family=Electrolize&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Orbitron:wght@400;700&family=Electrolize&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

     <style>
        /* 1. BRAND COLORS & RESET */
        :root {
            --um-maroon: #800000;
            --um-gold: #d4af37;
            --um-bg: #f4f4f4;
        }

        body { 
            margin: 0; padding: 0; 
            background-color: var(--um-bg) !important; 
            font-family: 'Outfit', sans-serif;
            color: #333;
        }

        /* 2. NAVBAR STYLES */
        .navbar { 
            background: var(--um-maroon); 
            padding: 1rem 5%; 
            display: flex; 
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            border-bottom: 3px solid var(--um-gold);
        }
        
        .nav-link { 
            color: rgba(255,255,255,0.9); 
            text-decoration: none; 
            padding: 0.5rem 1.2rem; 
            font-weight: 400;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: var(--um-gold);
        }

        .active { 
            color: var(--um-gold) !important;
            font-weight: 700;
        }

        /* 3. MAIN CONTAINER */
        .container { 
            padding: 40px 5%; 
            max-width: 1200px; 
            margin: 0 auto;
        }

        /* 4. CARDS & TABLES (Glassmorphism Light) */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }

        h1, h2, h3 { 
            color: var(--um-maroon); 
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        table { 
            width: 100%; border-collapse: collapse; margin-top: 20px;
        }
        th { 
            text-align: left; padding: 15px; 
            background-color: #f9f9f9; 
            color: var(--um-maroon);
            border-bottom: 2px solid var(--um-gold);
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        td { padding: 15px; border-bottom: 1px solid #eee; }

        /* 5. BUTTONS - Maroon & Gold */
        .btn-um { 
            background: var(--um-maroon); 
            color: white; 
            padding: 10px 25px; 
            border-radius: 50px; 
            text-decoration: none; 
            display: inline-block;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }
        .btn-um:hover { 
            background: #600000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(128,0,0,0.3);
        }

        .logout-btn {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid var(--um-gold);
            padding: 5px 15px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
        }
        .logout-btn:hover { background: var(--um-gold); color: black; }
    </style>

    </head>
    <nav class="navbar">
        <div style="color: white; font-weight: 700; font-size: 1.2rem; margin-right: 30px;">
            UM <span style="color: var(--um-gold);">ENROLLMENT</span>
        </div>

        <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Dashboard</a>
        
        @auth
            <a href="{{ route('enrollments.index') }}" class="nav-link {{ Request::routeIs('enrollments.index') ? 'active' : '' }}">RECORDS</a>
            <a href="{{ route('enrollments.create') }}" class="nav-link {{ Request::routeIs('enrollments.create') ? 'active' : '' }}">ENROLL</a>
    
            <form method="POST" action="{{ route('logout') }}" style="margin-left: auto;">
                @csrf
                <button type="submit" class="logout-btn">LOGOUT ({{ Auth::user()->name }})</button>
            </form>
        @else
            <div style="margin-left: auto; display: flex; gap: 15px;">
                <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">LOGIN</a>
                <a href="{{ route('register') }}" class="nav-link {{ Request::is('register') ? 'active' : '' }}">REGISTER</a>
            </div>
        @endauth
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
