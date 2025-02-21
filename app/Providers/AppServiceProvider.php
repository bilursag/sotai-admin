<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void
  {
  }

  public function boot(): void
  {
    Gate::define('admin-access', function ($user) {
      return $user->hasRole('admin');
    });

    Schema::defaultStringLength(200);
  }
}
