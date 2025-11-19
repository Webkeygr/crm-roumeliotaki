<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Blade::directive('date', function ($expression) {
            return '<?php
                if (!empty(' . $expression . ')) {
                    if (' . $expression . ' instanceof \Carbon\CarbonInterface) {
                        echo ' . $expression . '->format("d/m/Y");
                    } else {
                        echo \Carbon\Carbon::parse(' . $expression . ')->format("d/m/Y");
                    }
                }
            ?>';
        });
    }
}
