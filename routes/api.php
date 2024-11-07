<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ActionLogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

// Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

// get post
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('postTitle/search',[PostController::class,'searchTitle']);
Route::post('post/detail',[PostController::class,'detail']);

// get country
Route::get('country',[PostController::class,'countryList']);

// get category
Route::get('category',[PostController::class,'categoryList']);
Route::post('category/search',[PostController::class,'barSearch']);

Route::post('post/actionLog',[ActionLogController::class,'actionLog']);

