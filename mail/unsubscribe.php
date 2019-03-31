<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 12.03.19
 * Time: 16:15
 */

ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки )

/**
 * INSERT IGNORE INTO `subscription` (email) SELECT email FROM `form_users_mail` GROUP BY email;
 */

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use App\Index\Config;
use Medoo\Medoo;

/** @var Config $conf */
$conf = new Config(dirname(__FILE__));
$app = $conf->getApp();

/** @var Medoo $db */
$db = $app['db'];
$app['debug'] = new \App\Add\Debug($db);

$result = [
    'color' => 'red',
    'msg'   => 'Ошибка отписки от рассылки',
];

if (isset($_GET['m'])) {
    $email = base64_decode($_GET['m']);

    $res = $db->get('subscription', '*', ['email' => $email]);

    if (!empty($res)) {
        $db->update(
            'subscription',
            ['unsubscribe' => date('Y-m-d H:i:s')],
            ['email' => $email]
        );

        $result = [
            'color' => 'blue',
            'msg'   => 'Вы успешно отписались от рассылки',
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение email</title>
</head>
<body>
<h1 style="color:<?= $result['color'] ?>; width: 100%; text-align: center; margin-top: 50px;">
    <?= $result['msg'] ?>
</h1>
</body>
</html>
