<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserController;

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


// resources controllers route for CRUD
Route::apiResource('articles', ArticlesController::class);

//search route
Route::get('/articles/search/{searchVar}', [ArticlesController::class,'search']);

//user
\Route::post('/register', [UserController::class, "register"]);
