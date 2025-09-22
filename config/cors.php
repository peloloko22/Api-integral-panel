<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', "storage/*"],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        '*'
        /* 'https://api.oipsp.org', // 🟢 reemplazalo por tu dominio real */
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
