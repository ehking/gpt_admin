<?php

return [
    'guard' => 'api',
    'private_key' => env('PASSPORT_PRIVATE_KEY'),
    'public_key' => env('PASSPORT_PUBLIC_KEY'),
    'client_uuids' => true,
];
