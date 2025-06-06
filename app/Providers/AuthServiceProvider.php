<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('student', function ($user) {
            return $user->role === 'student'  || $user->role === 'admin';
        });
        Gate::define('teacher', function ($user) {
            return $user->role === 'teacher'  || $user->role === 'admin';
        });
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}