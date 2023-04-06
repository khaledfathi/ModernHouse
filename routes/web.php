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
use App\Http\Controllers\UserManagmentController;
use Illuminate\Support\Carbon;
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

    Route::get('customer' , [CustomerController::class , 'CustomerPage'])->middleware('admin'); 
    Route::get('newcustomer' , [CustomerController::class , 'NewCustomer'])->middleware('admin'); 
    Route::get('customer/{id}' , [CustomerController::class , 'CustomerProfile']);
    Route::get('customerdelete/{id}' , [CustomerController::class , 'DeleteCustomer'])->middleware('admin');
    Route::get('customerupdate' , [CustomerController::class , 'UpdateCustomer'])->middleware('admin');


    Route::get('project' , [ProjectController::class , 'ProjectPage']);
    Route::get('newproject' , [ProjectController::class , 'NewProject'])->middleware('admin');
    Route::get('payment' , [ProjectController::class , 'PaymentPage']); 
    Route::get('newpayment' , [ProjectController::class , 'NewPayment']);
    Route::get('payment/{id}' , [ProjectController::class , 'PaymentProfile']); 
    Route::get('paymentupdate' , [ProjectController::class , 'UpdatePayment']);
    Route::get('paymentdelete/{id}' , [ProjectController::class , 'DeletePayment'])->middleware('admin');
    Route::get('project/{id}' , [ProjectController::class , 'ProjectProfile']); 
    Route::get('projectdelete/{id}' , [ProjectController::class , 'DeleteProject'])->middleware('admin'); 
    Route::get('projectupdate' , [ProjectController::class , 'UpdateProject'])->middleware('admin');
    Route::get('projectreport/{id}' , [ProjectController::class , 'ProjectReport']); 

    Route::get('bill' , [BillController::class , 'BillPage']);
    Route::get('newbill' , [BillController::class , 'NewBill']);
    Route::get('bill/preview' , [BillController::class , 'BillPreviewPage']);
    Route::get('billprofile/{id}' , [BillController::class , 'BillProfile']); 
    Route::get('billdelete/{id}' , [BillController::class , 'DeleteBill'])->middleware('admin'); 
    //For Ajax
    Route::get('bill/getcustomerbyphone' , [BillController::class , 'AjaxGetCustomerByPhone']);
    Route::get('bill/getproductbyid' , [BillController::class , 'AjaxGetProductById']);

    Route::get('product' , [ProductController::class , 'ProductPage']); 
    Route::get('product/{id}' , [ProductController::class , 'ProductProfile']); 
    Route::post('productupdate' , [ProductController::class , 'UpdateProduct'])->middleware('admin');
    Route::get('addproduct' , [ProductController::class , 'AddProductPage'])->middleware('admin'); 
    Route::post('newproduct' , [ProductController::class , 'NewProduct'])->middleware('admin'); 
    Route::get('productdelete/{id}' , [ProductController::class , 'DeleteProduct'])->middleware('admin');

    route::get('category' , [CategoryController::class , 'CategoryPage']);
    route::get('newcategory' , [CategoryController::class , 'NewCategory'])->middleware('admin');
    route::get('categorydelete/{id}' , [CategoryController::class , 'DestroyCategory'])->middleware('admin');
    route::get('category/{id}' , [CategoryController::class , 'CategoryProfile']);
    route::get('categoryupdate' , [CategoryController::class , 'UpdateCategory'])->middleware('admin');

    Route::get('transaction' , [TransactionController::class , 'TransactionPage'])->middleware('admin');
    Route::post('newtransaction' , [TransactionController::class , 'NewTransaction'])->middleware('admin');
    Route::get('transactionquery',[TransactionController::class , 'TransactionQueryPage'])->middleware('admin'); 
    Route::get('transactionfind' , [TransactionController::class , 'QueryFind'])->middleware('admin'); 
    Route::get('transaction/{id}' , [TransactionController::class , 'TransactionProfile'])->middleware('admin');
    Route::post('transactionupdate', [TransactionController::class , 'UpdateTransaction'])->middleware('admin');
    Route::get('transactiondelete/{id}', [TransactionController::class , 'DestroyTransaction'])->middleware('admin');


    Route::get('report' , [ReportController::class , 'ReportPage'])->middleware('admin'); 

    Route::get('setting' , [SettingController::class , 'SettingPage'])->middleware('admin');
    Route::get('usersmanagment' , [UserManagmentController::class , 'UserManagmentPage'])->middleware('admin'); 
    Route::get('user', [UserManagmentController::class , 'UserPage'])->middleware('admin'); 
    Route::post('newuser', [UserManagmentController::class , 'NewUser'])->middleware('admin'); 
    Route::get('userdelete/{id}' , [UserManagmentController::class , 'DestroyUser'])->middleware('admin');
    Route::get('user/{id}', [UserManagmentController::class , 'UserProfile'])->middleware('admin'); 
    Route::post('userupdate', [UserManagmentController::class , 'UpdateUser'])->middleware('admin');
    Route::post('logoupdate', [SettingController::class ,'UpdateLogo']);
    Route::get('backup' , [SettingController::class , 'BackupPage']) ; 
    Route::get('exportdb' , [SettingController::class , 'ExportDatabase']);
    Route::post('importdb' , [SettingController::class , 'ImportDatabase']);

    Route::get('profile' , [ProfileController::class , 'ProfilePage']);
    Route::get('changepassword' , [ProfileController::class , 'ChangePassword']);
    Route::get('changephone' , [ProfileController::class , 'ChangePhone']);

    Route::get('notallowed' , fn()=>view('notAllowed.notAllowed'));

});


Route::get ('dd' , function (){
    dd(Logo()); 
}); 
