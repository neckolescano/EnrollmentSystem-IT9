<x-guest-layout>
    <h2 class="login-title">Login to your Account</h2>
    <p class="login-subtitle">Access your student records and enrollment portal securely.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label>Email Address</label>
            <input type="email" name="email" required autofocus placeholder="Enter your email">
        </div>

        <div class="mt-2">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter your password">
        </div>

        <div style="text-align: right; margin-top: -5px;">
            <a href="{{ route('password.request') }}" style="color: white; font-size: 0.7rem; text-decoration: none;">Forgot your password?</a>
        </div>

        <button type="submit" class="btn-login">
            LOGIN
        </button>
    </form>
</x-guest-layout>