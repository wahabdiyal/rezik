<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;

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
Route::post('login',[UserController::class,'userLogin']);
Route::post('signup',[UserController::class,'signUp']);
Route::get('search',[UserController::class,'searchJob']);

/***********************Company*******************************/
Route::post('company/login',[CompanyController::class,'login']);
Route::post('company/register',[CompanyController::class,'registerCompany']);
