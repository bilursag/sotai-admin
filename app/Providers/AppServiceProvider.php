<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
  }
}
