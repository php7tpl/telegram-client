<?php

use PhpBundle\TelegramClient\Helpers\WebHelper;
use App\Dialog\Domain\Services\PredictService;
use PhpLab\Core\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../src/Bootstrap/autoload.php';

include __DIR__ . '/../config/bootstrap.php';

/** @var ContainerInterface $container */

$notifyHtml = '';
$message = $_POST['message'] ?? '';

if ( ! empty($_POST)) {
    $predictService = $container->get(PredictService::class);
    try {
        $answerText = $predictService->predictText($message);
        $message = '';
        $notifyHtml = '<div style="color: green">'.$answerText.'</div>';
    } catch (NotFoundException $e) {
        $notifyHtml = '<div style="color: #b8b800">empty</div>';
    }
}

?>

<?= WebHelper::getDocumentHead() ?>

<?= $notifyHtml ?>

<form name="fos_user_profile_form" method="post" action="/dialog.php">
    <input type="text" name="message" placeholder="Enter message" tabindex="1" size="60" />
    <br/>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= WebHelper::getDocumentFoot() ?>
