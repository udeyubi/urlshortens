<?php

use App\Http\Controllers\UrlshortController;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[UrlshortController::class,'index'])                ->name('urlshorts.index');
Route::POST('/',[UrlshortController::class,'store'])               ->name('urlshorts.store');
Route::get('/{urlshorts}',[UrlshortController::class,'redirect'])  ->name('urlshorts.redirect');
