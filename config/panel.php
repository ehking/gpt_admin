<?php

return [
    'default_roles' => [
        'admin' => [
            'manage-panels',
            'manage-users',
            'manage-forms',
            'manage-reports',
        ],
        'designer' => [
            'manage-forms',
            'manage-reports',
        ],
        'analyst' => [
            'view-reports',
        ],
    ],

    'form_builder' => [
        'storage_disk' => env('FORM_BUILDER_STORAGE_DISK', 'local'),
    ],

    'report_builder' => [
        'default_timeout' => env('REPORT_BUILDER_DEFAULT_TIMEOUT', 10),
    ],
];
