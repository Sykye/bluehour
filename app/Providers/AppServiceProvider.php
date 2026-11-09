<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Service;
use App\Policies\OrderPolicy;
use App\Policies\ServicePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
    }
}