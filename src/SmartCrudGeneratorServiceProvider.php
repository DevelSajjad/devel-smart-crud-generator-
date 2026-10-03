<?php

namespace Devel\SmartCrudGenerator;

use Illuminate\Support\ServiceProvider;

class SmartCrudGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(
            __DIR__.'/../routes/web.php'
        );
    }
}