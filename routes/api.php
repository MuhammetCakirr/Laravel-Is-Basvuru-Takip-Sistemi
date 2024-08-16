<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    /*Skills Operations*/
    Route::prefix('skill')->group(function () {
        Route::post('create', [SkillController::class, 'create']);
        Route::post('delete', [SkillController::class, 'delete']);
        Route::put('update', [SkillController::class, 'update']);
    });

    /*Job Post Operations*/
    Route::prefix('job-post')->group(function () {
        Route::post('create', [PostController::class, 'create']);
        Route::post('delete', [PostController::class, 'delete']);
        Route::put('update', [PostController::class, 'update']);
        Route::get('get-all',[PostController::class, 'getAll']);
        Route::get('get/{id}',[PostController::class, 'getById']);
    });

    /*Job Requirement Operations*/
    Route::prefix('job-requirement')->group(function () {
        Route::post('create', [RequirementController::class, 'create']);
        Route::post('delete', [RequirementController::class, 'delete']);
        Route::put('update', [RequirementController::class, 'update']);
    });

    /*Job Application*/
    Route::prefix('job-application')->group(function () {
        Route::post('create', [JobApplicationController::class, 'create']);
        Route::post('delete', [JobApplicationController::class, 'delete']);
        Route::put('update', [JobApplicationController::class, 'update']);
    });

    /*My Application and Post*/
    Route::prefix('my')->group(function () {
        Route::prefix('application')->group(function (){
            Route::post('get-all', [JobApplicationController::class, 'getAllMyApplication']);
            Route::post('get/{id}', [JobApplicationController::class, 'getMyApplicationById']);
        });
        Route::prefix('post')->group(function (){
            Route::post('get-all', [PostController::class, 'getAllMyPost']);
            Route::post('get/{id}', [PostController::class, 'getMyPostById']);
            Route::post('application', [JobApplicationController::class, 'getApplicationOfMyPost']);
        });

    });
});
