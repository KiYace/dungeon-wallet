<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('tags', 'TagsCrudController');
    Route::crud('player', 'PlayerCrudController');
    Route::crud('skin', 'SkinCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('expense', 'ExpenseCrudController');
    Route::crud('income', 'IncomeCrudController');
    Route::crud('goal', 'GoalCrudController');
    Route::crud('boss', 'BossCrudController');
}); // this should be the absolute last line of this file
