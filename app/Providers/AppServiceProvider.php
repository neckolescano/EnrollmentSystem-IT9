<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
    // 1. Full Power
    Gate::define('admin-only', function ($user) {
        return $user->role === 'Administrator';
    });

    // 2. Staff Power (Registrar + Admin can both do this)
    Gate::define('registrar-access', function ($user) {
        return in_array($user->role, ['Administrator', 'Registrar Staff']);
    });

    // 3. Student Power
    Gate::define('student-only', function ($user) {
        return $user->role === 'Student';
    });
}
}