<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});
Route::resource('/trips', TripController::class);
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/tickets/purchase', [TicketController::class, 'purchase'])->name('tickets.purchase');
Route::get('/', [HomeController::class,'index'])->name('home');
