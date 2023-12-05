<?php

namespace Payment4\CryptoGateway;

use Illuminate\Support\ServiceProvider;

class Payment4ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('payment4.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'payment4');
    }
}
