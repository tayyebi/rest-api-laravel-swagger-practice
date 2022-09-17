<?php
namespace App\Providers;

use App\Models\LoginResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GateProvider extends AuthServiceProvider {
    public function boot()
    {
        parent::boot();
        
        Gate::define('provinces-get', function() {
            return true;
        });
        Gate::define('provinces-post', function() {
            return Auth::user()['type'] == 'administrator';
        });
        Gate::define('provinces-put-delete', function() {
            return Auth::user()['type'] == 'administrator';
        });

        Gate::define('cities-get', function() {
            return true;
        });
        Gate::define('cities-post', function() {
            return Auth::user()['type'] == 'administrator';
        });
        Gate::define('cities-put-delete', function() {
            return Auth::user()['type'] == 'administrator';
        });
        
    }
}