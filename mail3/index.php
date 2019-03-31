<?php
//declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 30.11.18
 * Time: 20:25
 */

ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки ))

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\App;
use App\Mail\Functions;
use App\Mail\Mailer;

/** @var App $app */
$app = new App();
$fn = new Functions($app);

$res = [
    'error' => true,
    'msg'   => 'Ошибка в проверочном коде'
];

if ($fn->checkCaptcha()) {

    $rec = $fn->getRecord();

}




if ($res['error'] == false) {

    $mailer = new Mailer();
    $m = $mailer->getMailer();

}

