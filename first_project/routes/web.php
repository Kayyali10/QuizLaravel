<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashoardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[DashoardController::class,'index'])->name('dashboard');

