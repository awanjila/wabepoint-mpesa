<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


// use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Landing'))->name('landing');
Route::get('/pricing', fn () => Inertia::render('Pricing'))->name('pricing');
Route::get('/about', fn () => Inertia::render('About'))->name('about');
Route::get('/partners', fn () => Inertia::render('Partners'))->name('partners');
Route::get('/resources', fn () => Inertia::render('Resources'))->name('resources');


Route::controller(BlogController::class)->group(function(){
   

    ///frontend///
    Route::get('show/blog/{slug}', 'ShowBlog')
    ->name('blogs.show')
    ->where('slug', '[A-Za-z0-9\-]+');

    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
    // Route::get('blogs', 'IndexOfClientBlogs')->name('blogs.index');

    // Route::get('news', 'IndexOfClientBlogs')->name('blogs.index');

    Route::get('news', [BlogController::class, 'index'])->name('blogs.index');

   });

