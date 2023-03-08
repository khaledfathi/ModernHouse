<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
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


Route::get('login' , [LoginController::class , 'LoginPage'])->middleware('guest'); 
Route::post('login' , [LoginController::class , 'Login'])->name('login'); 
Route::get('logout' , [LoginController::class , 'Logout']);  

Route::middleware(['auth'])->group(function () {
    Route::get('search' , [SearchController::class , 'SearchPage']); 
    Route::get('find' , [SearchController::class , 'Find']); 

    Route::get('customer' , [CustomerController::class , 'CustomerPage']); 
    Route::get('newcustomer' , [CustomerController::class , 'NewCustomer']); 

    Route::get('newproject' , [ProjectController::class , 'ProjectPage']);

    Route::get('bill' , [BillController::class , 'BillPage']); 

    Route::get('product' , [ProductController::class , 'ProductPage']); 

    Route::get('transaction' , [TransactionController::class , 'TransactionPage']);

    Route::get('report' , [ReportController::class , 'ReportPage']); 

    Route::get('setting' , [SettingController::class , 'SettingPage']); 

    Route::get('profile' , [ProfileController::class , 'ProfilePage']); 
});



Route::get ('dd' , function (){
    dd(session()->all()); 
}); 