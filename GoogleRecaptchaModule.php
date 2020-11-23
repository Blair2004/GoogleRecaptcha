<?php
namespace Modules\GoogleRecaptcha;

use App\Classes\Hook;
use Illuminate\Support\Facades\Event;
use App\Services\Module;
use Modules\GoogleRecaptcha\Events\GoogleRecaptchaEvent;
use Modules\GoogleRecaptcha\Http\Controllers\GoogleRecaptchaController;

class GoogleRecaptchaModule extends Module
{
    public function __construct()
    {
        parent::__construct( __FILE__ );

        Hook::addFilter( 'ns-login-footer', [ GoogleRecaptchaEvent::class, 'loadSignInFooter' ]);
        Hook::addFilter( 'ns-register-footer', [ GoogleRecaptchaEvent::class, 'loadSignupFooter' ]);
        Hook::addFilter( 'ns-login-fields', [ GoogleRecaptchaEvent::class, 'signInFields' ]);
        Hook::addFilter( 'ns-register-fields', [ GoogleRecaptchaEvent::class, 'signUpFields' ]);
        Hook::addFilter( 'ns-dashboard-menus', [ GoogleRecaptchaEvent::class, 'registerMenus' ]);
        Hook::addFilter( 'ns.settings', [ GoogleRecaptchaEvent::class, 'settingsProvider' ], 10, 2 );
        Hook::addAction( 'ns-login-form', [ GoogleRecaptchaEvent::class, 'watchLoginForm' ]);
        Hook::addAction( 'ns-register-form', [ GoogleRecaptchaEvent::class, 'watchLoginForm' ]);
    }
}