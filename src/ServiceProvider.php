<?php

/*
 * This file is part of the shiran/easyip.
 *
 * (c) shiran <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
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
