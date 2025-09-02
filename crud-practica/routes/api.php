<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('/user', UserController::class);

Route::apiResource('/post', PostController::class);

Route::apiResource('/comment', CommentController::class);