<?php

namespace App\Providers;

use App\Models\Modul;
use App\Policies\ModulPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Modul::class, ModulPolicy::class);
    }
}
