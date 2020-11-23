<?php

use App\Services\Helper;

return [
    'label'     =>      __( 'General Settings' ),
    'fields'    =>      [
        [
            'type'  =>  'text',
            'label' =>  __( 'Google Site Key' ),
            'name'  =>  'gr_google_site_key',
            'value' =>  $options->get( 'gr_google_site_key' ),
            'description'   =>  __( 'Provide the Google site key.' )
        ], [
            'type'  =>  'text',
            'label' =>  __( 'Google Secret Key' ),
            'name'  =>  'gr_google_secret_key',
            'value' =>  $options->get( 'gr_google_secret_key' ),
            'description'   =>  __( 'Provide the Google secret key.' )
        ], [
            'type'      =>  'switch',
            'label'     =>  __( 'Enable For Login' ),
            'options'   =>  Helper::kvToJsOptions([ 'no' => __( 'No' ), 'yes' => __( 'Yes' ) ]),
            'name'      =>  'gr_enable_login',
            'value'     =>  $options->get( 'gr_enable_login' ),
            'description'   =>  __( 'Makes Google Recaptcha works on Login page.' )
        ], [
            'type'      =>  'switch',
            'label'     =>  __( 'Enable For Registration' ),
            'options'   =>  Helper::kvToJsOptions([ 'no' => __( 'No' ), 'yes' => __( 'Yes' ) ]),
            'name'      =>  'gr_enable_registration',
            'value'     =>  $options->get( 'gr_enable_registration' ),
            'description'   =>  __( 'Makes Google Recaptcha works on registration page.' )
        ]
    ]
];