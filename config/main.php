<?php

use danog\MadelineProto\Logger;

return [
    'app_info' => [
        'api_id' => $_ENV['API_ID'] ?? null,
        'api_hash' => $_ENV['API_HASH'] ?? null,
        'phone_number' => $_ENV['PHONE'] ?? null,
        'device_model' => 'Linux',
        'system_version' => 'v0.1',
        'app_version' => 'v0.1',
    ],
    'updates' => [
        'handle_updates' => false
    ],
    'logger' => [
        'logger' => Logger::ECHO_LOGGER,
        //'logger_param' => __DIR__ . '/../var/MadelineProto.log',
        //'logger_level' => Logger::ULTRA_VERBOSE
    ],
    'authorization' => [ // Authorization settings
        'default_temp_auth_key_expires_in' => 86400 * 24 * 365, // a day (for better security, lower is better), will be automatically regenerated afterwards
    ],
    'serialization' => [
        'serialization_interval' => 30,
        //Очищать файл сессии от некритичных данных.
        //Значительно снижает потребление памяти при интенсивном использовании, но может вызывать проблемы
        'cleanup_before_serialization' => true,
    ],

/*
    //для доступа может потребоваться socks5 прокси
    //если прокси не требуется, то этот блок можно удалить.
    'connection_settings' => [
        'all' => [
            'proxy' => '\SocksProxy',
            'proxy_extra' => [
                'address' => 'xxx.xxx.xxx.xxx',
                'port' => 1234,
                'username' => '',//Можно удалить если логина нет
                'password' => '',//Можно удалить если пароля нет
            ],
        ],
    ],
    */
];