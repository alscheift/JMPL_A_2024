<?php

return [
    'enabled' => env('RECAPTCHA_ENABLED', false),
    'site_key' => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'max_attempts' => env('RECAPTCHA_MAX_ATTEMPTS', 3),
];