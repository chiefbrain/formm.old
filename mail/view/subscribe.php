<div style="font: 12px/14px Arial,Verdana,sans-serif; color: #797979;margin-top: 0;">
    <table style="min-width: 200px; max-width: 600px;">
        <tr>
            <td style="padding: 10px 5px; font-size: 20px;">
                Сообщение для вас:
            </td>
        </tr>
        <tr>
            <td>
                <table style="color: #000000; font-size: 14px;">
                    <tr>
                        <td style="padding: 5px; width: 50px;">Отправитель:</td>
                        <td><?= $data['name']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; width: 50px;">Email:</td>
                        <td><a href="mailto:<?= $data['email']; ?>"><?= $data['email']; ?></a></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; width: 50px;">Сообщение:</td>
                        <td><?= $data['text']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; width: 50px;">&nbsp;</td>
                        <td><?= $data['dop']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;">

            </td>
        </tr>
        <tr>
            <td style="padding: 5px; font-size: 16px; color: #f90;">
                Пожалуйста, не используйте функцию "Ответить/Reply", адресуйте ответ на Контактный email
                <a href="mailto:<?= $data['email']; ?>"><?= $data['email']; ?></a>
                 отправителя письма.
            </td>
        </tr>
<!--        <tr>-->
<!--            <td style="padding: 5px;">-->
<!--                <a href="https://formm.ru/mail/unsubscribe.php?m=@--><?//= $data['b64email']; ?><!--">Отказаться от рассылки</a>-->
<!--            </td>-->
<!--        </tr>-->
    </table>
</div>
