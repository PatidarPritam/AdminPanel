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
})->name('login');

Route::post('/register',[AuthController::class,'addUser']);
Route::Post('/login',[AuthController::class,'loginUser']);
Route::get('/logout',[AuthController::class,'logoutUser']);

Route::middleware('auth:student')->group(function () {
 //   Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('show',[EmployeeController::class,'show'])->name('show');
    Route::get('/add', [EmployeeController::class, 'add'])->name('add');
    Route::post('/addEmployee', [EmployeeController::class, 'addEmployee'])->name('addEmployee');
    Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
});


///  crud for dashboard
     




