<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee;

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

Route::get('/', function (Request $request) {
    return 'Welcome to API';
});

//Route::get('users', 'UserController@getIndex');

Route::get('/get_all_posts', [employee::class, 'index']);
Route::post('/create_post', [employee::class, 'store']);
Route::get('/get_single_post/{id}', [employee::class, 'show']);
Route::put('/update_post/{id}', [employee::class, 'update']);
Route::delete('/delete_post/{id}', [employee::class, 'destroy']);