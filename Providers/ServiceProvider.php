<?php
namespace Modules\GoogleRecaptcha\Providers;

use App\Classes\Hook;
use App\Providers\AppServiceProvider;
use Modules\GoogleRecaptcha\Events\GoogleRecaptchaEvent;

class ServiceProvider extends AppServiceProvider
{
    public function boot()
    {
        // ...
    }

    public function register()
    {
        Hook::addFilter( 'ns-login-footer', [ GoogleRecaptchaEvent::class, 'loadSignInFooter' ]);
        Hook::addFilter( 'ns-register-footer', [ GoogleRecaptchaEvent::class, 'loadSignupFooter' ]);
        Hook::addFilter( 'ns-login-fields', [ GoogleRecaptchaEvent::class, 'signInFields' ]);
        Hook::addFilter( 'ns-register-fields', [ GoogleRecaptchaEvent::class, 'signUpFields' ]);
        Hook::addFilter( 'ns-dashboard-menus', [ GoogleRecaptchaEvent::class, 'registerMenus' ], 15 );
        Hook::addFilter( 'ns.settings', [ GoogleRecaptchaEvent::class, 'settingsProvider' ], 10, 2 );
        Hook::addAction( 'ns-login-form', [ GoogleRecaptchaEvent::class, 'watchLoginForm' ]);
        Hook::addAction( 'ns-register-form', [ GoogleRecaptchaEvent::class, 'watchLoginForm' ]);
    }
}