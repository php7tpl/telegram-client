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
            '/src/Client/Migrations',
        ],
    ],
];
