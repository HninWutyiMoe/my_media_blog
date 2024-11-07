<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Trend_PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    // For Profile Details
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('updateProfile',[ProfileController::class,'updateProfile'])->name('profile#update');
    // For Photo
    Route::get('change',[ProfileController::class,'changeProfile'])->name('change#profile');
    Route::post('profileUpdate',[ProfileController::class,'profileUpdate'])->name('update#profile');
    // For Password
    Route::get('change/Password',[ProfileController::class,'changePass'])->name('admin#password');
    Route::post('updating',[ProfileController::class,'updatePass'])->name('update#pass');

    // For Admin List
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAdmin'])->name('admin#delete');
    Route::post('admin/search',[ListController::class,'search'])->name('admin#search');

    // Country
    Route::get('country',[CountryController::class,'index'])->name('admin#country');
    Route::post('country/search',[CountryController::class,'countrySearch'])->name('country#search');
    Route::post('country/add',[CountryController::class,'adding'])->name('country#add');
    Route::get('country/edit/{id}',[CountryController::class,'edit'])->name('country#edit');
    Route::post('country/update',[CountryController::class,'update'])->name('country#update');
    Route::get('delete/country/{id}',[CountryController::class,'delete'])->name('country#delete');

    // Category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/search',[CategoryController::class,'categorySearch'])->name('category#search');
    Route::post('category/add',[CategoryController::class,'adding'])->name('category#add');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('category/update',[CategoryController::class,'update'])->name('category#update');
    Route::get('delete/category/{id}',[CategoryController::class,'delete'])->name('category#delete');

    // Post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('allPost/search',[PostController::class,'postSearch'])->name('post#search');
    Route::post('post/create',[PostController::class,'create'])->name('post#create');
    Route::get('view/post/{id}',[PostController::class,'view'])->name('post#view');
    Route::get('delete/post/{id}',[PostController::class,'delete'])->name('post#delete');
    Route::get('edit/post/{id}',[PostController::class,'edit'])->name('post#edit');
    Route::post('update/post/{id}',[PostController::class,'update'])->name('post#update');

    // Trend Post
    Route::get('trend/post',[Trend_PostController::class,'index'])->name('admin#trendPost');
    Route::get('trend/view/{id}',[Trend_PostController::class,'view'])->name('trend#view');
    Route::post('trendPost/search',[Trend_PostController::class,'search'])->name('trendPost#search');
});
