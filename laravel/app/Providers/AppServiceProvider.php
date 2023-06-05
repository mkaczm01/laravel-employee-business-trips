<?php

declare(strict_types=1);

namespace App\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Console\Seeds\SeedCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(MigrationsEnded::class, static function () {
            Artisan::call(SeedCommand::class, [
                '--class' => DatabaseSeeder::class,
            ]);
        });
    }
}
