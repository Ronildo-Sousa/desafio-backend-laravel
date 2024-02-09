<?php

use App\Http\Controllers\Auth\LoginUsercontroller;
use App\Http\Controllers\Auth\RegisterUsercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->group(function(){
    Route::post('/register', RegisterUsercontroller::class)->name('register');
    Route::post('/login', LoginUsercontroller::class)->name('login');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/dashboard', fn() => 'dashboard page');
});