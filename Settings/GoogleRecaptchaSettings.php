<?php
namespace Modules\GoogleRecaptcha\Settings;

use App\Models\Role;
use App\Services\Helper;
use App\Services\Options;
use App\Services\SettingsPage;

class GoogleRecaptchaSettings extends SettingsPage
{
    const IDENTIFIER = 'google-recaptcha';
    const AUTOLOAD = true;
    
    public function __construct()
    {
        $options    =   app()->make( Options::class );
        
        $this->form    =   [
            'title' =>  __( 'Google Recaptcha' ),
            'description'   =>  __( 'Google Recaptcha settings' ),
            'tabs'  =>  [
                'general'    =>  include( dirname( __FILE__ ) . '/../SettingsShape/general.php' ),
            ]
        ];
    }
}