<?php

use Illuminate\Support\Facades\Route;
use Modules\GoogleRecaptcha\Http\Controllers\GoogleRecaptchaController;

Route::middleware( 'auth' )->group( function() {
    Route::get( '/dashboard/google-recaptcha/settings', [ GoogleRecaptchaController::class, 'settings' ]);
});