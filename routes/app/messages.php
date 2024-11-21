<?php

use App\Http\Controllers\Messages\Download;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Messages\Index;
use Illuminate\Support\Facades\Artisan;

Route::middleware('auth')->group(function () {
    Route::prefix('messages')
        ->as('messages.')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('sync', function () {
                Artisan::call('app:synchronize-spv-messages');
                return redirect()->to('/messages')->with('message', 'Sincronizare completa');
            })->name('sync');
            Route::get('{id}/invoice', Download::class)->name('download');
        });
});
