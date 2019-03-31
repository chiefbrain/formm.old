<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 12.03.19
 * Time: 20:43
 */

$result = [
    'color' => 'blue',
    'msg'   => base64_encode('oblnn@yandex.ru'),
];

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
