<?php

use App\Services\Helper;

return [
    'label'     =>      __m( 'General Settings', 'GoogleRecaptcha' ),
    'fields'    =>      [
        [
            'type'  =>  'text',
            'label' =>  __m( 'Google Site Key', 'GoogleRecaptcha' ),
            'name'  =>  'gr_google_site_key',
            'value' =>  $options->get( 'gr_google_site_key' ),
            'description'   =>  __m( 'Provide the Google site key.', 'GoogleRecaptcha' )
        ], [
            'type'  =>  'text',
            'label' =>  __m( 'Google Secret Key', 'GoogleRecaptcha' ),
            'name'  =>  'gr_google_secret_key',
            'value' =>  $options->get( 'gr_google_secret_key' ),
            'description'   =>  __m( 'Provide the Google secret key.', 'GoogleRecaptcha' )
        ], [
            'type'      =>  'switch',
            'label'     =>  __m( 'Enable For Login', 'GoogleRecaptcha' ),
            'options'   =>  Helper::kvToJsOptions([ 'no' => __m( 'No', 'GoogleRecaptcha' ), 'yes' => __m( 'Yes', 'GoogleRecaptcha' ) ]),
            'name'      =>  'gr_enable_login',
            'value'     =>  $options->get( 'gr_enable_login' ),
            'description'   =>  __m( 'Makes Google Recaptcha works on Login page.', 'GoogleRecaptcha' )
        ], [
            'type'      =>  'switch',
            'label'     =>  __m( 'Enable For Registration', 'GoogleRecaptcha' ),
            'options'   =>  Helper::kvToJsOptions([ 'no' => __m( 'No', 'GoogleRecaptcha' ), 'yes' => __m( 'Yes', 'GoogleRecaptcha' ) ]),
            'name'      =>  'gr_enable_registration',
            'value'     =>  $options->get( 'gr_enable_registration' ),
            'description'   =>  __m( 'Makes Google Recaptcha works on registration page.', 'GoogleRecaptcha' )
        ]
    ]
];