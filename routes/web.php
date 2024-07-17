<?php

use App\Http\Controllers\AuthController;
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

Route::get('dashboard', function () {
    return view('dashboard');
});
Route::post('/register',[AuthController::class,'addUser']);

Route::Post('/login',[AuthController::class,'loginUser']);
