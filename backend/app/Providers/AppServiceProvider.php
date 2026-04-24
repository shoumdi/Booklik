<?php

namespace App\Providers;

use App\Domain\Contribute\Adapters\StripeCheckoutGateway;
use App\Domain\Contribute\Interfaces\CheckoutGateway;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StripeClient::class, fn() => new StripeClient(config('services.stripe.secret')));
        $this->app->bind(CheckoutGateway::class, StripeCheckoutGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
