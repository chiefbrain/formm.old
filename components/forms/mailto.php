<?php
defined('PROTECT') or die('Restricted access');

$app['title']    = 'Напишите нам';
//$GLOBALS['descript'] = '';
$app['keywords'] = 'контакты, ';

//header ("Location: http://".$_SERVER['HTTP_HOST'].$url.'/'.$query);exit;
/*
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: http://".$_SERVER['HTTP_HOST']."/mailto.html");
  exit(); */

/** use comb */
$comb = '';
if ($app['comb']) {
    $comb = '.comb';
}
?>
<form action="/mail_div/" onsubmit="return formm.sub(this);" enctype="multipart/form-data" method="post">
    <input type="hidden" name="return_time" value="14" />
    <input type="hidden" name="check" value="name:Ваше имя?.email:Укажите правильный e-mail.text:Напишите сообщение!.captcha:Ошибка в проверочном коде"/>
    <input type="hidden" name="colors" value="eee.eee.f70.eee"/>
    <input type="hidden" name="warning" value="off" />
    <div class="forma">
        <div class="ftitle"><strong>Напишите нам</strong></div>
        <div class="forma2">
            <div class="name">Ваше имя</div>
            <input class="pole" name="name" maxlength="50" type="text"/>
            <div class="name">Обратный e-mail</div>
            <input class="pole" name="email" maxlength="50" type="text"/>
            <div class="name">Сообщение</div>
            <textarea name="text" rows="5" cols="20"></textarea>

            <div style="margin-top:10px;">
                <div class="name">Прикрепить файл</div>
                <input class="file" name="file" type="file" multiple="multiple" size="46" />
            </div>

            <div style="width:100%;min-height:50px;margin-top:10px;">
                <a href="https://formm.ru/">форма обратной связи</a>
                <img border="0" style="cursor:pointer;margin:9px;float:left;" src="/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>
                <div style="margin-left: 160px;">
                    <div class="name">Проверочный код</div>
                    <input class="pole" name="captcha" style="margin-left: -2px;" maxlength="6" type="text"/>
                </div>
                <div style="width:100%;height:10px;float:left;"></div>
            </div>

            <!--
            <table style="width:100%;margin-top:10px;table-layout:fixed;border-collapse:collapse;">
                    <tr>
                            <td style="width:100px;text-align:center;"><a href="http://www.formm.ru/">форма обратной связи</a></td>
                            <td style="width:60px;text-align:center;"><img border="0" style="cursor:pointer;width:50px; height:50px;" src="http://formm.ru/refresh/008.gif" alt="refresh" title="refresh" onclick="formm.cap();"/></td>
                            <td><div class="name">Проверочный код</div><input class="pole" name="captcha" type="text"  maxlength="6" /></td>
                    </tr>
            </table>
            -->
            <div class="fbott">
                <input class="button" type="submit" value="Отправить" style="width:155px;height:30px;" />
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="/mail/js/formm.p.js<?= $comb ?>"></script>

<!--
<script type="text/javascript">//<![CDATA[
var c=0;
/*var _0x319d=["\x65\x6C\x65\x6D\x65\x6E\x74\x73","\x66\x6F\x72\x6D\x6D","\x66\x6F\x72\x6D\x73","\x6C\x65\x6E\x67\x74\x68","\x6E\x61\x6D\x65","\x76\x61\x6C\x75\x65","\x66\x69\x6C\x65","","\u0417\u0430\u043F\u043E\u043B\u043D\u0438\u0442\u0435\x20\u0432\u0441\u0435\x20\u043F\u043E\u043B\u044F\x20\u0444\u043E\u0440\u043C\u044B","\x6D\x61\x74\x63\x68","\x65\x6D\x61\x69\x6C","\u0423\u043A\u0430\u0436\u0438\u0442\u0435\x20\u043F\u0440\u0430\u0432\u0438\u043B\u044C\u043D\u044B\u0439\x20\x65\x2D\x6D\x61\x69\x6C","\x63\x61\x70\x74\x63\x68\x61","\u041E\u0448\u0438\u0431\u043A\u0430\x20\u0432\x20\u043F\u0440\u043E\u0432\u0435\u0440\u043E\u0447\u043D\u043E\u043C\x20\u043A\u043E\u0434\u0435"];function subm(){
var _0x9ba6x2={};var _0x9ba6x3=document[_0x319d[2]][_0x319d[1]][_0x319d[0]];for(var _0x9ba6x4=0;_0x9ba6x4<_0x9ba6x3[_0x319d[3]];_0x9ba6x4++){var _0x9ba6x5=_0x9ba6x3[_0x9ba6x4][_0x319d[4]];var _0x9ba6x6=_0x9ba6x3[_0x9ba6x4][_0x319d[5]];if(_0x9ba6x5!=_0x319d[6]&&_0x9ba6x6==_0x319d[7]){alert(_0x319d[8]);return false;} else {_0x9ba6x2[_0x9ba6x5]=_0x9ba6x6;} ;} ;if(!_0x9ba6x2[_0x319d[10]][_0x319d[9]](/^[a-z\d]+((\.|\-|\_)?[a-z\d]+)*@[a-z\d]+((\.|\-)?[a-z\d]+)*\.[a-z]{2,4}$/i)){alert(_0x319d[11]);return false;} else {if(!_0x9ba6x2[_0x319d[12]][_0x319d[9]](/^[a-z\d]{5,6}$/i)){alert(_0x319d[13]);return false;} else {return true;} ;} ;} ;*/
//]]></script>
-->
