<?php

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

Route::get('/', [HomeController::class, 'index']);


Route::get('/user/{name}', [UserController::class, 'show']);

Route::get('/about', function (){
    return view('pages.about');
})->name('about');

Route::get('/log-in', function (){
    return redirect('/login');
});

    Route::group(
        [
        'middleware' => 'auth',
        'prefix' => 'app'
        ],
        function(){
            Route::get('dashboard' , DashboardController::class)->name('dashboard');
            Route::resources('tasks' , TaskController::class);
        }
    );

 Route::group(
        [
        'middleware' => 'is_admin',
        'prefix' => 'admin'
        ],
        function(){
           Route::get('stats', \App\Http\Controllers\Admin\StatsController::class);
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class);
        }
    );


require __DIR__.'/auth.php';
