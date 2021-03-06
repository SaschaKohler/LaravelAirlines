<?php

use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirlineController;

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

// please -> php artisan route:list

Route::resource('airlines', AirlineController::class);


//  passengers/{airline_id}?page=:page_number  returns 50 passengers per page

//Route::get('passengers/{airline_id}' , [PassengerController::class, 'getPassengersPerAirlinePaginated']);
Route::get('passengers', [PassengerController::class, 'index']);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('user/{username}',[UserController::class,'show']);
    Route::put('user/{id}', [UserController::class,'update']);
    Route::post('user/logout', [UserController::class, 'logout']);

});


