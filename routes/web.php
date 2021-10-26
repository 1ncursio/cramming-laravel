<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::group(['prefix' => '/posts', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    Route::get('/create', [PostController::class, 'create'])->name('posts.create');

    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');

    Route::patch('/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::post('/', [PostController::class, 'store'])->name('posts.store');

    Route::post('/image', [PostController::class, 'storeImage'])->name('posts.storeImage');

    Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.delete');

    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});
