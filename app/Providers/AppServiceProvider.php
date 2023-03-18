<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('observer', function(User $user) {
            return $user->peran === 'Atasan' || $user->peran === 'Atasan Utama';
        });

        Gate::define('highObserver', function(User $user) {
            return $user->peran === 'Atasan Utama';
        });

        Gate::define('manager', function(User $user) {
            return $user->peran === 'Pengelola' || $user->peran === 'Pengelola Utama';
        });

        Gate::define('highManager', function(User $user) {
            return $user->peran === 'Pengelola Utama';
        });

        Gate::define('highOfficer', function(User $user) {
            return $user->peran === 'Atasan Utama' || $user->peran === 'Pengelola Utama';
        });

        Gate::define('superAdmin', function(User $user) {
            return $user->peran === 'Super Admin';
        });

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
