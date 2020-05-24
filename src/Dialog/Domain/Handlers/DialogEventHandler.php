<?php

namespace App\Dialog\Domain\Handlers;

use PhpBundle\TelegramClient\Actions\EchoAction;
use PhpBundle\TelegramClient\Actions\GroupAction;
use PhpBundle\TelegramClient\Actions\SendMessageAction;
use PhpBundle\TelegramClient\Actions\ShutdownServerAction;
use PhpBundle\TelegramClient\Handlers\BaseInputMessageEventHandler;
use PhpBundle\TelegramClient\Matchers\AnyMatcher;
use PhpBundle\TelegramClient\Matchers\EqualOfPatternsMatcher;
use PhpBundle\TelegramClient\Matchers\GroupAndMatcher;
use PhpBundle\TelegramClient\Matchers\IsAdminMatcher;
use App\Dialog\Domain\Actions\SearchAction;
use danog\MadelineProto\APIFactory;

class DialogEventHandler extends BaseInputMessageEventHandler
{

    protected function definitions(): array
    {
        /** @var APIFactory $apiFactory */

        $apiFactory = $this->messages;

        return [
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['~']),
                ]),
                'action' => new GroupAction($apiFactory, [
                    new \PhpBundle\TelegramClient\Actions\ConsoleCommandAction($apiFactory),
                ]),
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['echo']),
                ]),
                'action' => new GroupAction($apiFactory, [
                    new EchoAction($apiFactory),
                ]),
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['sleep']),
                ]),
                'action' => new GroupAction($apiFactory, [
                    new SendMessageAction($apiFactory, 'Buy! 👋'),
                    //new ShutdownHandlerAction($apiFactory, $this),
                    new ShutdownServerAction($apiFactory, $this),
                ]),
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new EqualOfPatternsMatcher([
                        'что такое',
                        'где искать',
                        'найди мне',
                        'где можно найти',
                        'поищи',
                        'где найти',
                        'как найти',
                        'где мне найти',
                    ]),
                ]),
                'action' => new SearchAction($apiFactory, [
                    'что такое',
                    'где искать',
                    'найди мне',
                    'где можно найти',
                    'поищи',
                    'где найти',
                    'как найти',
                    'где мне найти',
                ]),
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['help']),
                ]),
                'action' => new GroupAction($apiFactory, [
                    new SendMessageAction($apiFactory, file_get_contents(__DIR__ . '/../Resources/help.txt')),
                ]),
            ],
            [
                'matcher' => new AnyMatcher,
                'action' => new \App\Dialog\Domain\Actions\DataBaseAction($apiFactory),
            ],
        ];
    }

}