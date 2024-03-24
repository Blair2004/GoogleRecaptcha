<?php

/**
 * Google Recaptcha Controller
 * @since  1.0
 * @package  modules/GoogleRecaptcha
**/

namespace Modules\GoogleRecaptcha\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\DashboardController;
use Modules\GoogleRecaptcha\Settings\GoogleRecaptchaSettings;

class GoogleRecaptchaController extends DashboardController
{
    /**
     * Index Controller Page
     * @return  view
     * @since  1.0
    **/
    public function settings()
    {
        return GoogleRecaptchaSettings::renderForm();
    }
}
