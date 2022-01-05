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

// routes/web.php

// Rotte pubbliche
// Route::get('/', 'PageController@index');

// Rotte Autenticazione
Auth::routes();

// Rotte area Admin
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('foods', 'FoodController');
});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');