<?php

namespace App\Providers;

use App\Repository\Skin\SkinRepository;
use App\Repository\Tag\EloquentSkinRepository;
use App\Repository\Tag\EloquentTagRepository;
use App\Repository\Tag\TagRepository;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            // tag
            [
                TagRepository::class,
                EloquentTagRepository::class
            ],
            [
                SkinRepository::class,
                EloquentSkinRepository::class
            ]
        ];

        foreach ($repositories as $repository) {
            app()->bind($repository[0], $repository[1]);
        }
    }
}
