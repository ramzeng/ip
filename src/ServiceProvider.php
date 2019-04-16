<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-02-21
 * Time: 18:04
 */

namespace Shiran\EasyIp;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/easyip.php' => config_path('easyip.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/easyip.php', 'easyip'
        );

        $this->app->singleton(EasyIp::class, function () {
            return new EasyIp(config('easyip'));
        });

        $this->app->alias(EasyIp::class, 'EasyIp');
    }

    public function provides()
    {
        return [EasyIp::class, 'EasyIp'];
    }
}