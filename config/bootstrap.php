<?php

use danog\MadelineProto\API;
use Illuminate\Container\Container;
use PhpLab\Core\Legacy\Yii\Helpers\FileHelper;
use Symfony\Component\Console\Application;

$container = Container::getInstance();
$container->bind(Application::class, Application::class, true);
$container->bind(API::class, function (): API {
    $sessionName = $_ENV['APP_ENV'] . '/session/madeline';
    FileHelper::createDirectory(__DIR__ . '/../var/' . $_ENV['APP_ENV'] . '/session');
    $sessionFileName = __DIR__ . '/../var/' . $sessionName;
    $sessionFileName = FileHelper::normalizePath($sessionFileName);
    $settings = include(__DIR__ . '/../config/main.php');;
    $api = new API($sessionFileName, $settings);
    $api->start();
    return $api;
}, true);

$container->bind(\App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\TagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerTagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerOptionRepository::class);
