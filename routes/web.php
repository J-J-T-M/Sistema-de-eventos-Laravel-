<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\EventController;
use  App\Http\Controllers\ContactController;


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

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create']);
Route::post('/events', [EventController::class, 'store']);

Route::get('/events/contact', [ContactController::class, 'index']);


