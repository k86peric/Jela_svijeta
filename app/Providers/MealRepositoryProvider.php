<?php

namespace App\Providers;

use App\Repositories\MealRepository;
use Illuminate\Support\ServiceProvider;

class MealRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MealRepository::class, function ($app) {
            return new MealRepository();
        });
    }
}