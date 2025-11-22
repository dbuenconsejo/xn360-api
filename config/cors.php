<?php

return [
    'paths' => ['api/*', 'api/v2/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5174', 'http://localhost:5173/', 'http://xn360-fe-dev.s3-website-us-west-1.amazonaws.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
