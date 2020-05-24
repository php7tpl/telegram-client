<?php

use PhpBundle\TelegramClient\Helpers\WebHelper;
use danog\MadelineProto\API;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../src/Bootstrap/autoload.php';

include __DIR__ . '/../config/bootstrap.php';

/** @var ContainerInterface $container */

$notifyHtml = '';
$username = $_POST['username'] ?? '';
$message = $_POST['message'] ?? '';

if ( ! empty($username)) {
    ob_start();
    $api = $container->get(API::class);
    $api->messages->sendMessage([
        'peer' => $username,
        'message' => $message,
    ]);
    $log = ob_get_contents();
    $username = '';
    $message = '';
    $notifyHtml = '<div style="color: green">Message sent!</div>';
}

?>

<?= WebHelper::getDocumentHead() ?>

<?= $notifyHtml ?>

<form name="fos_user_profile_form" method="post" action="/">
    <input type="text" name="username" placeholder="Enter username" value="<?= $username ?>">
    <br/>
    <textarea name="message" class="form-control" placeholder="Enter message"><?= $message ?></textarea>
    <br/>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
if(!empty($log)) {
    echo '<pre><code>' . $log . '</code></pre>';
}
?>

<?= WebHelper::getDocumentFoot() ?>
