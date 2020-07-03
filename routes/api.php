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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('registation', 'AuthController@registation');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('admin', 'adminController@login');
    Route::post('admin/reg', 'adminController@registation');
    Route::post('admin/logout', 'adminController@logout');
    Route::post('admin/refresh', 'adminController@refresh');
    Route::post('admin/me', 'adminController@me');
});

//employee api
Route::apiResource('/employee','employee\EmployeeController');
//supplier api
Route::apiResource('/supplier','supplier\SuplierController');
//category api
Route::apiResource('/category','category\CategoryController');
//product api
Route::get('/all/category','product\ProductController@getCategory');
Route::get('/all/supplier','product\ProductController@getSupplier');
Route::apiResource('/product','product\ProductController');
//expense api
Route::apiResource('/expense','expense\ExpenseController');
