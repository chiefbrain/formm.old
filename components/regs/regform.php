<?php
defined('PROTECT') or die('Restricted access');
?>

<form action="" method="post" onsubmit="return formm.sub(this);">

    <input type="hidden" name="check"
           value="name:Ваше имя?.email:Укажите правильный e-mail.link:Укажите точный адрес страницы где Вы разместили форму!.captcha:Ошибка в проверочном коде"/>

    <div class="forma">

        <div class="ftitle"><strong>Регистрация формы</strong></div>

        <div class="forma2">

            <div class="name">Ваше имя</div>
            <input class="pole" name="name" maxlength="50" type="text"/>

            <div class="name">E-Mail для сообщений</div>
            <input class="pole" name="email" maxlength="50" type="text"/>

            <div class="name">Точный адрес страницы где Вы разместили форму,
                например: http://www.formm.ru/forms/mailto.php
            </div>
            <input class="pole" name="link" maxlength="250" type="text"/>

            <div style="width:100%;min-height:60px;margin-top:10px;">
                <!--overflow:auto;">-->

                <!--<a style="display:bloc;width:100px;text-align:center;float:left;" href="http://www.formm.ru/">форма обратной связи</a>-->

                <img style="float:left;border:none;/*width:180px;height:60px;*/"
                     src="/captcha/" alt="formm.captcha" title="captcha"/>

                <img style="border:none;cursor:pointer;margin:10px 14px; float:left;"
                     src="http://formm.ru/refresh/refresh.png"
                     alt="formm.refresh" title="refresh"
                     onclick="formm.cap();"/>
                <div style="margin-left:160px;">
                    <div style="margin:15px 0 10px 0;">Проверочный код</div>

                    <input name="captcha" type="text" class="pole"
                           maxlength="6"/>
                </div>
                <div style="width:100%;height:10px;float:left;"></div>
            </div>
            <div class="fbott">
                <input class="button" type="submit" value="Отправить"
                       style="width:155px;height:30px;"/>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="/mail/js/captcha.p.js"></script>
<!--<script type="text/javascript" src="/js/visits.js"></script>-->
