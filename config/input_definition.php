<?php

use PhpBundle\TelegramClient\Handlers\BaseInputMessageEventHandler;
use danog\MadelineProto\APIFactory;

/** @var BaseInputMessageEventHandler $this */
/** @var APIFactory $apiFactory */

$apiFactory = $this->messages;

return [

    /*
    [
        'matcher' => new EqualOfPatternsMatcher(['hi', 'привет']),
        'action' => new SendRandomMessageAction($apiFactory, [
            'привет! как твои дела?',
            'привет',
            'приве! как ты?',
        ]),
    ],
    [
        'matcher' => new EqualAndOfPatternsMatcher(['как дела', 'как ты']),
        'action' => new SendRandomMessageAction($apiFactory, [
            'не лежим в джакузи, но и сухари не сушим...',
            'отлично',
            'хорошо',
            'пойдет',
            'чудесно',
        ]),
    ],
    [
        'matcher' => new EqualOfPatternsMatcher([
            '🥝',
            '🍋',
            '🍊',
            '🍐',
            '🍎',
        ]),
        'action' => new SendRandomMessageAction($apiFactory, [
            'спасибо',
            'а че так мало принес?',
            'оставь это себе',
            'спасибо! я отложу это на вечер',
        ]),
    ],
    [
        'matcher' => new EqualOfPatternsMatcher(['help me']),
        'action' => new SendMessageAction($apiFactory, 'Fuck you asshole!!!'),
    ],
    [
        'matcher' => new EqualOfPatternsMatcher(['help']),
        'action' => new SendMessageAction($apiFactory, 'HELP'),
    ], */

];
