<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 28.11.18
 * Time: 20:50
 */

ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки ))

use App\Add\Captcha\Captcha;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$captcha = new Captcha();
$res = $captcha->getCaptcha();

//foreach ($res['headers'] as $k => $v) {
//    header($k . ': ' . $v);
//}

//session_start();
//$_SESSION['captcha_keystring'] =  $res['string'];
//$_SESSION['captchaHash'] =  $res['hash'];
echo base64_encode($res['img']);
