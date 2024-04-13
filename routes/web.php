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

Route::get('/' , [HomeController::class , 'index']);

Route::get('/user/[name]' , [UserController::class , 'show']);

Route::get('/about', function () { return view('pages.about'); })->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::get('/log-in', function (){
    return redirect('/login');
});

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below
Route::group(
    ['middleware' => 'auth'
    'prefix' => 'app'
    ],
    function(){
         Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resource('tasks', TaskController::class);
    }
)

    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    // Put one Route Group code line here below

    Route::group(
    [
    'middleware' => 'is_admin',
    'prefix' => 'admin'
    ],
    function (){
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class);
        Route::get('stats', \App\Http\Controllers\Admin\StatsController::class);
    }
)

        // Tasks inside that /admin group:


        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below


        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below


    // End of the /admin Route Group

// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__.'/auth.php';
