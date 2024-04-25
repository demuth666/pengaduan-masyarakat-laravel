<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Aduan;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/pengaduan', Aduan::class)->name('pengaduan');
});
