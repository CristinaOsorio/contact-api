<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

Route::post('/contacts', [ContactController::class, 'store'] );
Route::get('/contacts', [ContactController::class, 'index'] );
Route::get('/contacts/{id}', [ContactController::class, 'show'] );
Route::put('/contacts/{id}', [ContactController::class, 'update'] );
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'] );
