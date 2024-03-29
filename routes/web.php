<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Dashboard;
use App\Livewire\DashboardItem;

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/realization/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/realization/public/livewire/update', $handle)
        ->middleware(['auth', 'verified']); 
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

/*Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/zni/{id}/{edit?}',DashboardItem::class)->name('zni.edit');
});

require __DIR__.'/auth.php';
