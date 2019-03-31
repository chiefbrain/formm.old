<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 28.11.18
 * Time: 20:50
 */

use App\Add\Captcha\Captcha;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$captcha = new Captcha();
$res = $captcha->getCaptcha();

foreach ($res['headers'] as $k => $v) {
    header($k . ': ' . $v);
}

echo $res['img'];