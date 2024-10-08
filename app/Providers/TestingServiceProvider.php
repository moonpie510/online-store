<?php

namespace App\Providers;

use App\Support\Testing\FakerImageProvider;
use Illuminate\Support\ServiceProvider;
use Faker\Factory;
use Faker\Generator;
class TestingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
