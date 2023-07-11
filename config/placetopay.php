<?php

return [
    'login' => env(key: 'PLACETOPAY_LOGIN'),
    'tranKey' => env(key: 'PLACETOPAY_TRANKEY'),
    'baseUrl' => env(key: 'PLACETOPAY_URL'),
    'timeout' => env(key: 'PLACETOPAY_TIMEOUT', default: 15),
];
