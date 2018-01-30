<?php

namespace heshanh\Abn;

use heshanh\Abn;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Setup the soap client
        $this->app->singleton(Abn\SoapClient::class, function () {
            return (new Abn\SoapClient(
                config('services.abn.service_url'),
                config('services.abn.guid'))
            );
        });
    }
}
