<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\Edit;
use App\Http\Controllers\Clients\Index;
use App\Http\Controllers\Clients\Store;
use App\Http\Controllers\Clients\Create;
use App\Http\Controllers\Clients\Update;

Route::middleware('auth')->group(function () {
    Route::prefix('clients')
        ->as('clients.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('{client}/edit', Edit::class)->name('edit');
            Route::put('{client}/update', Update::class)->name('update');
        });
});
