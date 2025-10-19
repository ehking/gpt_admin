<?php

return [
    'oauth' => [
        'provider' => env('OAUTH_PROVIDER', 'google'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', env('OAUTH_CLIENT_ID')),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', env('OAUTH_CLIENT_SECRET')),
        'redirect' => env('GOOGLE_REDIRECT_URI', env('OAUTH_REDIRECT_URI')),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', env('OAUTH_CLIENT_ID')),
        'client_secret' => env('GITHUB_CLIENT_SECRET', env('OAUTH_CLIENT_SECRET')),
        'redirect' => env('GITHUB_REDIRECT_URI', env('OAUTH_REDIRECT_URI')),
    ],

    'azure' => [
        'client_id' => env('AZURE_CLIENT_ID', env('OAUTH_CLIENT_ID')),
        'client_secret' => env('AZURE_CLIENT_SECRET', env('OAUTH_CLIENT_SECRET')),
        'redirect' => env('AZURE_REDIRECT_URI', env('OAUTH_REDIRECT_URI')),
        'tenant' => env('AZURE_TENANT_ID'),
    ],

    'passport' => [
        'personal_access_client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'personal_access_client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
        'password_client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
        'password_client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
    ],
];
