<?php

namespace App\Providers;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

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
    public function boot(): void
    {
        Gate::define('superadmin', function(User $user){

            return $user->is_admin == 0;
        });
        Gate::define('ketua', function(User $user){

            return $user->is_admin == 1;
        });
        Gate::define('sekretaris', function(User $user){

            return $user->is_admin == 2;
        });
        Gate::define('staffDat', function(User $user){

            return $user->is_admin == 3;
        });
        Gate::define('staffHuk', function(User $user){

            return $user->is_admin == 4;
        });
        Gate::define('staffKeu', function(User $user){

            return $user->is_admin == 5;
        });
        Gate::define('staffTek', function(User $user){

            return $user->is_admin == 6;
        });
        
        
        
        
    }
}
