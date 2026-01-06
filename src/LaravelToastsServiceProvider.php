<?php

namespace HassanIrfan527\LaravelToasts;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use HassanIrfan527\LaravelToasts\Livewire\Toast;

class LaravelToastsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-toasts');

        Livewire::component('toast', Toast::class);

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-toasts'),
        ], 'laravel-toasts-views');

        $this->publishes([
            __DIR__ . '/../config/toasts.php' => config_path('toasts.php'),
        ], 'toasts-config');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/toasts.php',
            'toasts'
        );
        $this->app->singleton('laravel-toast', function ($app) {
        return new \HassanIrfan527\LaravelToasts\ToastManager();
    });
    }
}