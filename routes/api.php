<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CalendlyOauthController;
use Illuminate\Support\Facades\Route;

Route::post('/calendly/webhook', [CalendlyOauthController::class, 'handleWebhook']);
Route::get('/test', function () {
    return 'API route works';
});
