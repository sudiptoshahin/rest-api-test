<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\StudentClassController as StudentClassController;
use App\Http\Controllers\Api\StudentSectionController as StudentSectionController;
use App\Http\Controllers\Api\StudentController as StudentController;
use App\Http\Controllers\Api\UserController as UserController;

use App\Http\Controllers\AuthController as AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/class', StudentClassController::class);

Route::apiResource('/section', StudentSectionController::class);

Route::apiResource('/student', StudentController::class);

Route::apiResource('/user', UserController::class);

// Authentication Route

Route::group([

    // 'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('me', [AuthController::class, 'me']);

});