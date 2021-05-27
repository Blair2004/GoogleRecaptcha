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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Controller Page
     * @return  view
     * @since  1.0
    **/
    public function settings()
    {
        return $this->view( 'GoogleRecaptcha::settings', [
            'title'         =>  __m( 'Google ReCaptcha Settings', 'GoogleRecaptcha' ),
            'description'   =>  __m( 'Configure the security of your installation.', 'GoogleRecaptcha' )
        ]);
    }
}
