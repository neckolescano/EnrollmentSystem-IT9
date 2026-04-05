<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UM Enrollment System</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            background: url('/images/loginbg1.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: flex-end; 
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            width: 100%;
            max-width: 500px; /* Adjust width  */
            height: 100vh;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 50px;
            box-shadow: -10px 0 30px rgba(0,0,0,0.2);
            color: white;
        }

        .school-logo {
            width: 70px;
            margin: 0 auto 20px auto;
            display: block;
        }

        .login-title {
            text-align: center;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
        }

        .login-subtitle {
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 30px;
        }

        /* Pill Inputs */
        input {
            width: 100%;
            background: white !important;
            border: none !important;
            border-radius: 50px !important;
            padding: 14px 25px !important;
            margin-bottom: 15px;
            color: #333 !important;
            font-size: 0.9rem;
        }

        /* Gold Login Button */
        .btn-login {
            background-color: #d4af37; /* Gold color from inspo */
            color: white;
            font-weight: 700;
            border-radius: 50px;
            padding: 14px;
            width: 100%;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-register {
        background-color: #d4af37 !important; /* Gold */
        color: white !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 50px !important;
        padding: 10px 24px !important;
        width: auto;
        border: none !important;
        cursor: pointer;
        transition: 0.3s;
        }

        /* Instructions Box */
        .instruction-box {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 20px;
            margin-top: 40px;
            font-size: 0.8rem;
            line-height: 1.4;
        }

        label { 
            color: white !important;
            font-size: 0.75rem; 
            font-weight: 600; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
            display: block; 
            padding-left: 10px;
        }

            .glass-panel a {
            color: #ffffff !important;
            opacity: 0.8;
            text-decoration: none;
        }

            .glass-panel a:hover {
            opacity: 1;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="glass-panel">
        <img src="{{ asset('images/logo.png') }}" class="school-logo" alt="School Logo">
        
        {{ $slot }}

        <div class="instruction-box">
            <strong style="text-transform: uppercase; display: block; margin-bottom: 5px;">Login Instructions</strong>
            <ul style="margin: 0; padding-left: 15px; color: rgba(255,255,255,0.9);">
                <li>Enter your registered Email and Password.</li>
                <li>Ensure caps lock is off before typing.</li>
                <li>Contact the registrar for account concerns.</li>
            </ul>
        </div>
    </div>
</body>
</html>