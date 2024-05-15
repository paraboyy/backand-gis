<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('getuser', [ApiController::class, 'get_user']);

    Route::get('/markers', [HomeController::class, 'index']);
    Route::get('/markers/{id}', [HomeController::class, 'show']);
    Route::post('/markers', [HomeController::class, 'store']);
    Route::put('/markers/{id}', [HomeController::class, 'update']);
    Route::delete('/markers/{id}', [HomeController::class, 'destroy']);
    Route::post('/markers/search', [HomeController::class, 'search']);
    /**
      * Silahkan tambahkan route anda disini ...
    */
});
