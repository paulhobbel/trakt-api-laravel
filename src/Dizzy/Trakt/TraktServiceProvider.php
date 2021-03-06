<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 00:52
 */

namespace Dizzy\Trakt;

use Illuminate\Support\ServiceProvider;

/**
 * Class TraktServiceProvider
 * @package Dizzy\Trakt
 */
class TraktServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__."/config/trakt.php" => config_path('trakt.php')
        ]);

        $this->mergeConfigFrom(
            __DIR__."/config/trakt.php", 'trakt'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('trakt', function($app) {
            return new Trakt();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Trakt::class];
    }
}