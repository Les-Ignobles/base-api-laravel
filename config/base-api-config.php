<?php

return [
    'console' => [
        'domain_path'      => base_path('core/Domains'),
        'domain_namespace' => 'Core\Domains'
    ],

    'exception' => [
        'blacklist_request_parsing'  => [
            'password'              => '**SENSITIVE DATA***',
            'password_confirmation' => '**SENSITIVE DATA***'
        ],
        'common_error_log_channel'   => '',
        'critical_error_log_channel' => '',
        'log_enable'                 => true,
    ]
];
