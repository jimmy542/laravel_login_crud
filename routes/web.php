<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServicesController;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified'])->group(function (){

    // department crud
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/harddelete/{id}',[DepartmentController::class,'harddelete']);

    // service crud and upload image 
    Route::get('/services/all',[ServicesController::class,'index'])->name('service');
    Route::post('/services/add',[ServicesController::class,'add'])->name('addService');
    Route::get('/service/edit/{id}',[ServicesController::class,'edit']);
    Route::post('/service/update/{id}',[ServicesController::class,'update']);
    Route::get('/service/softdelete/{id}',[ServicesController::class,'softdelete']);
});

