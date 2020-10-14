<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Api\Country\CountryController;
Route::get('country', [CountryController::class, 'country']);
Route::get('country/{id}', [CountryController::class, 'countryById']);

use App\Http\Controllers\Api\Auth\LoginController;
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function() {
  Route::post('country', [App\Http\Controllers\Api\Country\CountryController::class, 'countrySave']);
  Route::put('country/{id}', [App\Http\Controllers\Api\Country\CountryController::class, 'countryEdit']);
  Route::delete('country/{country}', [App\Http\Controllers\Api\Country\CountryController::class, 'countryDelete']);
  Route::get('refresh', [App\Http\Controllers\Api\Auth\LoginController::class, 'refresh']);
});
