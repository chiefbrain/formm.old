<div style="font: 12px/14px Arial,Verdana,sans-serif; color: #797979;">
    <table style="min-width: 200px; max-width: 600px;">
        <tr>
           <td style="padding: 5px;">
               <a style="display: inline-block; padding: 5px; border:1px solid #f90;color:#f90; border-radius: 5px; text-decoration: none;" href="https://formm.ru/mail/subscribe.php?m=@<?= $data['b64email']; ?>">ПОДТВЕРДИТЬ</a>
           </td>
        </tr>
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
        <tr>
            <td style="padding: 5px; font-size: 12px;">
                Сообщение отправлено для подтверждения данного адреса электронной почты. Если это сообщение попало к вам по ошибке, просто проигнорируйте его.
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;">
                <a href="https://formm.ru/mail/unsubscribe.php?m=@<?= $data['b64email']; ?>">Formm.ru отказаться от рассылки</a>
            </td>
        </tr>
    </table>
</div>
