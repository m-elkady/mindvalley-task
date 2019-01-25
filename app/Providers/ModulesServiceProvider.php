<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $modules = glob(base_path('app/Modules') . '/*', GLOB_ONLYDIR);
        foreach ($modules as $module) {
            if (!file_exists($module . '/routes.php')) {
                continue;
            }
            Route::group(['middleware' => ['web']], function ($router) use ($module) {
                require $module . '/routes.php';
            });

        }
    }
}