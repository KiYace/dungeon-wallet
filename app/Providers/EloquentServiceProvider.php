<?php

namespace App\Providers;

use App\Repository\Expense\EloquentExpenseRepository;
use App\Repository\Expense\ExpenseRepository;
use App\Repository\Player\EloquentLevelRepository;
use App\Repository\Player\EloquentPlayerRepository;
use App\Repository\Player\LevelRepository;
use App\Repository\Player\PlayerRepository;
use App\Repository\Skin\EloquentSkinRepository;
use App\Repository\Skin\SkinRepository;
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
            ],
            [
                PlayerRepository::class,
                EloquentPlayerRepository::class
            ],
            [
                LevelRepository::class,
                EloquentLevelRepository::class
            ],
            [
                ExpenseRepository::class,
                EloquentExpenseRepository::class
            ]
        ];

        foreach ($repositories as $repository) {
            app()->bind($repository[0], $repository[1]);
        }
    }
}
