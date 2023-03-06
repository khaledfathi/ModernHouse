<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\Search;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});


Route::get('login' , [Login::class , 'LoginPage'])->middleware('guest'); 
Route::post('login' , [Login::class , 'Login'])->name('login'); 
Route::get('logout' , [Login::class , 'Logout']);  

Route::middleware(['auth'])->group(function () {
    Route::get('search' , [Search::class , 'SearchPage']); 
});
