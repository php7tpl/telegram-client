<?php

use PhpBundle\TelegramClient\Helpers\WebHelper;
use App\Dialog\Domain\Services\PredictService;
use PhpLab\Core\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../src/Bootstrap/autoload.php';

include __DIR__ . '/../config/bootstrap.php';

/** @var ContainerInterface $container */

$localsocket = 'tcp://127.0.0.1:1234';
$user = 'tester01';
$message = 'test';

// соединяемся с локальным tcp-сервером
$instance = stream_socket_client($localsocket);
// отправляем сообщение
fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n");

?>

<?= WebHelper::getDocumentHead() ?>

<script>
        ws = new WebSocket("ws://127.0.0.1:8000/?user=tester01");
        ws.onmessage = function(evt) {alert(evt.data);};
    </script>

<?= WebHelper::getDocumentFoot() ?>
