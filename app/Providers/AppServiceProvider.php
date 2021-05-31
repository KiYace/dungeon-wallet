<?php

namespace App\Providers;

use App\Service\Image\ImageLocalUploader;
use App\Service\Image\ImageUploader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ImageUploader::class, ImageLocalUploader::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
