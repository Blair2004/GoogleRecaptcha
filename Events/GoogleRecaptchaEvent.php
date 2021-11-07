<?php
namespace Modules\GoogleRecaptcha\Events;

use App\Classes\Output;
use App\Services\Options;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\GoogleRecaptcha\Settings\GoogleRecaptchaSettings;

/**
 * Register Events
**/
class GoogleRecaptchaEvent
{
    public static function loadSignInFooter( Output $output )
    {
        if ( ns()->option->get( 'gr_enable_login', 'yes' ) === 'yes' ) {
            $output->addView( 'GoogleRecaptcha::sign-in', [
                'options'   =>  app()->make( Options::class )
            ]);
        }

        return $output;
    }

    public static function loadSignupFooter( Output $output )
    {
        if ( ns()->option->get( 'gr_enable_registration', 'yes' ) === 'yes' ) {
            $output->addView( 'GoogleRecaptcha::sign-up', [
                'options'   =>  app()->make( Options::class )
            ]);
        }

        return $output;
    }

    public static function signInFields( $fields )
    {
        if ( ns()->option->get( 'gr_enable_login', 'yes' ) === 'yes' ) {
            $fields[]   =   [
                'type'  =>  'custom',
                'name'  =>  'grField'
            ];
        }

        return $fields;
    }

    public static function signUpFields( $fields )
    {
        if ( ns()->option->get( 'gr_enable_registration', 'yes' ) === 'yes' ) {
            $fields[]   =   [
                'type'  =>  'custom',
                'name'  =>  'grField'
            ];
        }

        return $fields;
    }

    public static function registerMenus( $menus )
    {
        if ( isset( ns()->store ) ) {
            if ( ! ns()->store->isMultiStore() && ! ns()->store->subDomainsEnabled() ) {
                $menus[ 'google-recaptcha' ]    =   [
                    'label'     =>  __m( 'Google Recaptcha', 'GoogleRecaptcha' ),
                    'icon'      =>  'la-fingerprint',
                    'href'      =>  url( '/dashboard/google-recaptcha/settings' )
                ];
            } else if ( ns()->store->isMultiStore() && ns()->store->subDomainsEnabled() ) {
                $menus[ 'settings' ][ 'childrens' ][]   =   [
                    'label'     =>      __m( 'Google Recaptcha', 'GoogleRecaptcha' ),
                    'href'      =>      url( '/dashboard/google-recaptcha/settings' )
                ];
            }
        } else {
            $menus[ 'settings' ][ 'childrens' ][]   =   [
                'label'     =>      __m( 'Google Recaptcha', 'GoogleRecaptcha' ),
                'href'      =>      url( '/dashboard/google-recaptcha/settings' )
            ];
        }
        
        return $menus;
    }

    public static function settingsProvider( $class, $identifier ) 
    {
        if ( $identifier === 'google-recaptcha.settings' ) {
            return new GoogleRecaptchaSettings;
        }

        return $class;
    }

    public static function watchLoginForm( Request $request )
    {
        $client                 =   new Client();
        $response               =   $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params'       =>  [
                'secret'        =>  ns()->option->get( 'gr_google_secret_key' ),
                'response'      =>  $request->input('grField'),
                'remoteip'      =>  request()->ip()
            ]
        ]);

        $response       =   json_decode($response->getBody(), true);
        $message        =   __m('The code has been successfully validated.', 'GoogleRecaptcha');

        if (isset($response['error-codes'])) {
            switch ($response['error-codes'][0]) {
                case 'missing-input-secret':
                    $message    =   'The secret parameter is missing.';
                    break;
                case 'invalid-input-secret':
                    $message    =   'The secret parameter is invalid or malformed.';
                    break;
                case 'missing-input-response':
                    $message    =   'The response parameter is missing.';
                    break;
                case 'invalid-input-response':
                    $message    =   'The response parameter is invalid or malformed.';
                    break;
                case 'bad-request':
                    $message    =   'The request is invalid or malformed.';
                    break;
                case 'timeout-or-duplicate':
                    $message    =   'The response is no longer valid: either is too old or has been used previously.';
                    break;
            }
        }
        
        if ( ! $response[ 'success' ] ) {
            throw new Exception( $message );
        }
    }
}