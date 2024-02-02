<?php

use App\Http\Controllers\Auth\RegisterUsercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->group(function(){
    Route::post('/register', RegisterUsercontroller::class)->name('register');
});
