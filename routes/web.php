<?php

use App\Http\Controllers\CategoryController;
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
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    Route::get('customer/{id}' , [CustomerController::class , 'CustomerProfile']);
    Route::get('customerdelete/{id}' , [CustomerController::class , 'DeleteCustomer']);
    Route::get('customerupdate' , [CustomerController::class , 'UpdateCustomer']);


    Route::get('project' , [ProjectController::class , 'ProjectPage']);
    Route::get('newproject' , [ProjectController::class , 'NewProject']);
    Route::get('payment' , [ProjectController::class , 'PaymentPage']); 
    Route::get('newpayment' , [ProjectController::class , 'NewPayment']); 
    Route::get('payment/{id}' , [ProjectController::class , 'PaymentProfile']); 
    Route::get('paymentupdate' , [ProjectController::class , 'UpdatePayment']); 
    Route::get('paymentdelete/{id}' , [ProjectController::class , 'DeletePayment']); 
    Route::get('project/{id}' , [ProjectController::class , 'ProjectProfile']); 
    Route::get('projectdelete/{id}' , [ProjectController::class , 'DeleteProject']); 
    Route::get('projectupdate' , [ProjectController::class , 'UpdateProject']); 

    Route::get('bill' , [BillController::class , 'BillPage']); 

    Route::get('product' , [ProductController::class , 'ProductPage']); 
    Route::get('product/{id}' , [ProductController::class , 'ProductProfile']); 
    Route::post('productupdate' , [ProductController::class , 'UpdateProduct']); 
    Route::get('addproduct' , [ProductController::class , 'AddProductPage']); 
    Route::post('newproduct' , [ProductController::class , 'NewProduct']); 
    Route::get('productdelete/{id}' , [ProductController::class , 'DeleteProduct']);

    route::get('category' , [CategoryController::class , 'CategoryPage']);
    route::get('newcategory' , [CategoryController::class , 'NewCategory']);
    route::get('categorydelete/{id}' , [CategoryController::class , 'DestroyCategory']);
    route::get('category/{id}' , [CategoryController::class , 'CategoryProfile']);
    route::get('categoryupdate' , [CategoryController::class , 'UpdateCategory']);

    Route::get('transaction' , [TransactionController::class , 'TransactionPage']);
    Route::post('newtransaction' , [TransactionController::class , 'NewTransaction']);
    Route::get('transactionquery',[TransactionController::class , 'TransactionQueryPage']); 
    Route::get('transactionfind' , [TransactionController::class , 'QueryFind']); 

    Route::get('report' , [ReportController::class , 'ReportPage']); 

    Route::get('setting' , [SettingController::class , 'SettingPage']); 

    Route::get('profile' , [ProfileController::class , 'ProfilePage']);
    Route::get('changepassword' , [ProfileController::class , 'ChangePassword']);
    Route::get('changephone' , [ProfileController::class , 'ChangePhone']);

});



Route::get ('dd' , function (){
    dd(session()->all()); 
}); 