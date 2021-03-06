<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/customers',[CustomerController::class, 'getAllCustomer']);
Route::get('/customer/{id}',[CustomerController::class, 'getCustomerById']);
Route::post('/delete',[CustomerController::class, 'delete']);
Route::post('/update',[CustomerController::class, 'update']);
Route::post('/create',[CustomerController::class, 'create']);

Route::group([
    'middleware'=> 'auth:api'
   ], function(){
    
   });