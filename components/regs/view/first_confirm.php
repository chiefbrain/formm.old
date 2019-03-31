<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<div style="font: 12px/14px Arial,Verdana,sans-serif; color: #797979;">
    <table style="min-width: 200px; max-width: 600px;">
        <tr>
            <td style="padding: 10px 5px; font-size: 16px; color: #000000;">

                Здравствуйте, <?= $data['user_name']; ?> !<br/><br/>
                Вы зарегистрировали форму обратной связи на странице:<br/>
                <a href="http://<?= $data['user_link']; ?>"><?= $data['user_link']; ?></a><br/><br/>

                <?php
                if ($data['confirm']) {
                    ?>
                    Чтобы завершить регистрацию<br>
                    осталось всего лишь
                    <h1>ПОДТВЕРДИТЬ</h1>
                    ваш адрес электронной почты
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
        if ($data['confirm']) {
            ?>
            <tr>
                <td style="padding: 5px;">
                    <a style="display: inline-block; padding: 5px; border:1px solid #f90;color:#f90; border-radius: 5px; text-decoration: none;"
                       href="https://formm.ru/mail/subscribe.php?m=@<?= $data['b64email']; ?>">
                        ПОДТВЕРДИТЬ
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td style="padding: 5px; font-size: 12px;">
                Наш сервис является бесплатным. Если наша форма обратной связи
                Вам понравилась,
                <a href="http://formm.ru/donate.html">можете выразить свою
                    благодарность по ссылке</a> http://formm.ru/donate.html
            </td>
        </tr>
        <?php
        if ($data['confirm']) {
            ?>
            <tr>
                <td style="padding: 5px; font-size: 12px;">

                    Сообщение отправлено для подтверждения данного адреса
                    электронной почты. Если это сообщение попало к вам по
                    ошибке,
                    просто проигнорируйте его.
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td style="padding: 5px;">
                <a href="https://formm.ru/mail/unsubscribe.php?m=@<?= $data['b64email']; ?>">Fprmm.ru отказаться
                    от рассылки</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
