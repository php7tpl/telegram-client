<?php

return [
    'fixture' => [
        'directory' => [
            'default' => '/src/Dialog/Domain/Fixtures',
        ],
    ],
    'migrate' => [
        'directory' => [
            'default' => '/src/Migrations',
            '/src/Dialog/Domain/Migrations',
            '/vendor/php7bundle/telegram-client/src/Migrations',
        ],
    ],
];
