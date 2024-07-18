<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorElement;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});


Route::post('/register',[AuthController::class,'addUser']);

Route::Post('/login',[AuthController::class,'loginUser']);

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('show',[EmployeeController::class,'show'])->name('show');
   
});


///  crud for dashboard
     
Route::get('/add',[EmployeeController::class,'add']);

Route::post('/addEmployee',[EmployeeController::class,'addEmployee']);




Route::delete('delete/{id}',[EmployeeController::class,'delete']);

Route::get('edit/{id}',[EmployeeController::class,'edit']);

Route::post('update/{id}',[EmployeeController::class,'update']);
