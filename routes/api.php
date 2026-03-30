<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DokuNotificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/doku/notification', DokuNotificationController::class)->name('api.doku.notification');
Route::post('/xendit/webhook', [\App\Http\Controllers\Api\XenditWebhookController::class, 'handle'])->name('api.xendit.webhook');
