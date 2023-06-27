<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactFormController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
	return $request->user();
});


Route::controller(NewsletterController::class)->group(function () {
	Route::post('/subscribe', 'store');
	Route::delete('/subscribe', 'destroy');
});

Route::controller(ContactFormController::class)->group(function () {
	Route::get('/contact', 'index');
	Route::post('/contact', 'store');
	Route::get('/contact/{id}', 'show');
});
