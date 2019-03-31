<?php
defined('PROTECT') or die('Restricted access');

if (isset($_POST['colors']) && $_POST['colors'] != '')
{
    $arrc = explode('.', $_POST['colors']);

    $cfon = $arrc[0];
    $cwin = $arrc[1];
    $ctxt = $arrc[2];
    $cbrd = $arrc[3];
}
else
{
    $cfon = 'fff';
    $cwin = 'ffe';
    $ctxt = '800';
    $cbrd = '800';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Сообщение. Форма обратной связи</title>

        <meta name="Description" content= "Сервис для создания почтовых html форм обратной связи, для сообщений с сайта или связи с администратором, форма заказа услуг или товара для Вашего сайта. Конструктор форм обратной связи не требует специальных знаний. Форма работает на любом хостинге, проста в настройке и установке."/>
        <meta name="Keywords" content="мастер форм обратной связи,конструктор форм,генератор формы,создать форму,создание формы,готовая форма,бесплатная форма,форма обратной связи бесплатно,форма обратной связи для ucoz,почтовая форма для сайта,форма заказа для сайта,обратной связи,обратная связь"/>

        <meta name="abstract" content="Вебсервис создан в помощь вебмастеров - форма, конструктор форм,генератор формы,создать форму,мастер форм,обратной связи"/>
        <meta name="subject" content="Вебсервис создания форм обратной связи"/>
        <meta name="site-created" content="10-10-2010"/>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Language" content="ru" />

        <style type="text/css">
            #fon {
                position:absolute;
                left:0;
                top:0;
                width:100%;
                height:100%;
                background:#<?= $cfon ?>;
            }

            #owin {
                position:absolute;
                left:50%;
                top:50%;
                margin:-125px 0 0 -250px;
                width:500px;
                height:250px;
                background: #<?= $cwin ?>;
                color: #<?= $ctxt ?>;
                border: 1px solid #<?= $cbrd ?>;
                font: 16px sans-serif;
            }
        </style>
    </head>
    <body>
        <h1><a href="/">Форма обратной связи-конструктор форм,генератор форм,создать форму,мастер форм обратной связи</a></h1>
        <div id="fon">
            <table id="owin">
                <tr style="height:20px;background:#<?= $cbrd ?>;">
                    <td>&nbsp;</td>
                </tr>
                <tr style="text-align:center;">
                    <td><?= $message; ?><p id="omes">&nbsp;</p></td>
                </tr>
                <tr style="text-align:center;height:40px;">
                    <td><input class="button" type="button" value="<?= $back_button ?>" onclick='<?= $blink ?>' /></td>
                </tr>
            </table>
        </div>


        <script type="text/javascript">/*<![CDATA[*/
            var t = <?= $return_time ?>;
            var m = "<?= $return_message ?>".split("%t");

            document.getElementById('omes').innerHTML = m[0] + t + m[1];
            setInterval(tim, 1000);
            function tim() {
                document.getElementById('omes').innerHTML = m[0] + (--t) + m[1];
            }
            window.setTimeout(function () {<?= $blink ?>
            }, t * 1000);
            /*]]>*/
        </script>

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter46503096 = new Ya.Metrika({
                            id: 46503096,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            webvisor: true
                        });
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () {
                            n.parentNode.insertBefore(s, n);
                        };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/46503096" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

    </body>
</html>
