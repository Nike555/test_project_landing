<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/sample-page-1', [PageController::class, 'samplePage1'])->name('samplePage1');
Route::get('/sample-page-2', [PageController::class, 'samplePage2'])->name('samplePage2');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('activity', [\App\Http\Controllers\Admin\ActivityController::class, 'activity'])->name('activity');
});

// Clear Cache facade value:
Route::get('/clear-all-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';
    echo '<hr>';
    $exitCode = Artisan::call('optimize');
    echo '<h1>Reoptimized class loader</h1>';
    echo '<hr>';
    $exitCode = Artisan::call('route:cache');
    echo '<h1>Routes cached</h1>';
    echo '<hr>';
    $exitCode = Artisan::call('route:clear');
    echo '<h1>Route cache cleared</h1>';
    echo '<hr>';
    $exitCode = Artisan::call('view:clear');
    echo '<h1>View cache cleared</h1>';
    echo '<hr>';
    $exitCode = Artisan::call('config:cache');
    echo '<h1>Clear Config cleared</h1>';
});
