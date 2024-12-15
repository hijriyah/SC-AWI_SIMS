<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // View::composer('layouts.layout', function ($view) {
        //     dd(session('Admin_user'));
        //     $adminSession = User::where('username', session('username'))->first();
        //     $view->with('adminSession', $adminSession);
        // });
    }
}
