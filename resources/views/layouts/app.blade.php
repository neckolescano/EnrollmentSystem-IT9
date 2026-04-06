<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>UM Enrollment System</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Monoton&family=Orbitron:wght@400;700&family=Electrolize&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

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

        /* 2. NAVBAR STYLES - NOW WHITE */
        .navbar { 
            background: #ffffff !important; /* Pure White Background */
            padding: 0.8rem 5%; 
            display: flex; 
            align-items: center;
            position: sticky; /* Stays at top while scrolling */
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08); /* Subtle shadow for depth */
        }
        
        .nav-link { 
            color: #444 !important; /* Dark text for readability on white */
            text-decoration: none; 
            padding: 0.5rem 1.2rem; 
            font-weight: 600;
            transition: 0.3s;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .nav-link:hover {
            color: var(--um-maroon) !important;
        }

        .active { 
            color: var(--um-maroon) !important;
            border-bottom: 2px solid var(--um-gold); /* Gold indicator for active page */
        }

        /* 3. MAIN CONTAINER */
        .container { 
            padding: 40px 3%; 
            max-width: 1200px; 
            margin: 0 auto;
            min-height: 80vh;
        }

        /* 4. CARDS & TABLES */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-top: 5px solid var(--um-maroon);
        }

        /* TABLE STYLE */
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0 10px; /* Gives rows a "card" look */
        }

        th { 
            background-color: transparent;
            color: var(--um-maroon);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 15px;
            border-bottom: 2px solid var(--um-gold);
        }

        td { 
            background-color: #fff;
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        h1, h2, h3 { 
            color: var(--um-maroon); 
            font-weight: 700;
            text-transform: uppercase;
        }

        /* 5. BUTTONS */
        .logout-btn {
            background: var(--um-maroon);
            color: white !important;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem;
            font-weight: bold;
            transition: 0.3s;
        }
        .logout-btn:hover { 
            background: #600000; 
            transform: scale(1.05);
        }


    </style>

    </head>
    <body>
    <nav class="navbar">
        <div style="font-family: 'Orbitron'; font-weight: 700; font-size: 1.3rem; margin-right: 40px; color: var(--um-maroon);">
            UM <span style="color: var(--um-gold);">ENROLLMENT</span>
        </div>

        {{-- Nav Links --}}
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

    <main>
        @if(!Request::is('/') && !Request::is('dashboard')) 
            <div class="container">
                @yield('content')
            </div>
        @else
            @yield('content')
        @endif
    </main>
</body>
</html>