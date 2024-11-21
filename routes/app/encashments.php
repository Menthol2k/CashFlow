<?php

use App\Http\Controllers\Encashments\Create;
use App\Http\Controllers\Encashments\Edit;
use App\Http\Controllers\Encashments\Index;
use App\Http\Controllers\Encashments\Store;
use App\Http\Controllers\Encashments\Update;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('encashments')
        ->as('encashments.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('{encashment}/edit', Edit::class)->name('edit');
            Route::put('{encashment}/edit', Update::class)->name('update');
        });
});
