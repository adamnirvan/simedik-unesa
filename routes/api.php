<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/webhook/xendit', [PatientController::class, 'xenditCallback']);

Route::get('/test', function () {
    return response()->json(['status' => 'ok', 'message' => 'API route works']);
});