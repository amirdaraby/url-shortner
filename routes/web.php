<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get("/test",[\App\Http\Controllers\TestController::class,"test"])->name("test");
Route::get("/show/{url}",[\App\Http\Controllers\TestController::class,"show"])->name("show");

Route::get("/find/{url?}",[\App\Http\Controllers\UrlController::class,"show"])->name("show");

Route::middleware("auth")->resource("url",\App\Http\Controllers\UrlController::class)
->parameters(["url"=>"id"]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
