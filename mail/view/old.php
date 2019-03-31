<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 12.03.19
 * Time: 23:40
 */

$msg = '';

//$msg .= '<b style="display:block;text-align:center;margin:10px 30px;padding:10px;border:1px solid #f90;color:#f90;">Вы получили сообщение через сервис обратной связи formm.ru<br/>'
//        . 'При ответе на это письмо будьте внимательны, проверяйте куда отправляете ответ.</b>'."\n".'';
//<input type="hidden" name="warning" value="off">
//===============================================================

if (isset($md[$mailDomen]) || isset($md[$eee]))
{
    if (!(isset($_POST['warning']) && $_POST['warning'] == 'off'))
    {
//                        $msg .= '<div style="display:block;text-align:center;margin:0 5px 5px 5px;padding:5px;border:1px solid #f90;color:#f90;">Проверяйте куда отправляете ответ, Ваш сервис обратной связи formm.ru</div>' . "\n" . '';
        $msg .= '<div style="display:block;text-align:center;margin:0 5px 5px 5px;padding:5px;border:1px solid #f90;color:#f90;">Пожалуйста, не используйте функцию "Ответить/Reply", адресуйте ответ на Контактный <b style="color: green;">E-MAIL</b> отправителя письма.</div>' . "\n";
    }
}
//===============================================================
//'Для ответа на это письмо кликните по email указанный ниже! <a href="http://formm.ru/blog-DMARC.html">подробней...</a></b>'."\n".'<br/><br/>';

$msg .= '<table>';

if ($name != '')
{
    $msg .= '<tr>' . "\n"
        . '<td ' . $std1 . '>' . "\n" . '<b>NAME:</b>' . "\n" . '</td>' . "\n"
        . '<td ' . $std2 . '>' . $name . '</td>' . "\n"
        . '</tr>' . "\n";
}

//if ($email != '' && preg_match("/^\w+(\.\-\w+)*@\w+(\.\-\w+)*\.\w{2,4}$/", $email))
if ($email != '' && preg_match("/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,6}$/", $email))
{
    //$msg .= '<b style="color:' . $colorn . ';">E-MAIL: </b>'."\n".'<a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a><br/>';
    $msg .= '<tr>' . "\n"
        . '<td ' . $std1 . '>' . "\n" . '<b>E-MAIL:</b>' . "\n" . '</td>' . "\n"
        . '<td ' . $std2 . '><a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a></td>' . "\n"
        . '</tr>' . "\n";
}
else if ($email != '')
{
    //$msg .= '<b style="color:' . $colorn . ';">E-MAIL: </b>'."\n".'<a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a><br/>';
    //$msg .= '<b style="color:red;">ВНИМАНИЕ! Вероятно отправитель неверно указал email! Соответственно, если Вы ответите на это сообщение, Ваш ответ получит не отправитель, а сервис обратной связи formm.ru</b>'."\n".'<br/>';
    $msg .= '<tr>' . "\n"
        . '<td ' . $std1 . '>' . "\n" . '<b>E-MAIL:</b>' . "\n" . '</td>' . "\n"
        . '<td ' . $std2 . '>'
        . '<a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a>'
        . '<br/><b style="color:red;">ВНИМАНИЕ! Вероятно отправитель неверно указал email!'
        . ' Соответственно, если Вы ответите на это сообщение, Ваш ответ получит не отправитель, а сервис обратной связи formm.ru</b>' . "\n"
        . '</td>' . "\n"
        . '</tr>' . "\n";
}
else
{
    //$msg .= '<b style="color:' . $colorn . ';">E-MAIL: </b>'."\n".'<a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a><br/>';
    //$msg .= '<b style="color:red;">ВНИМАНИЕ! Отправитель не указал email! Соответственно, если Вы ответите на это сообщение, Ваш ответ получит не отправитель, а сервис обратной связи formm.ru</b>'."\n".'<br/>';
    $msg .= '<tr>' . "\n"
        . '<td ' . $std1 . '>' . "\n" . '<b>E-MAIL:</b>' . "\n" . '</td>' . "\n"
        . '<td ' . $std2 . '>'
        . '<a href="mailto:' . urlencode($name) . '&lt;' . $email . '&gt;">' . $email . '</a>'
        . '<br/><b style="color:red;">ВНИМАНИЕ! Отправитель не указал email!'
        . ' Соответственно, если Вы ответите на это сообщение, Ваш ответ получит не отправитель, а сервис обратной связи formm.ru</b>' . "\n"
        . '</td>' . "\n"
        . '</tr>' . "\n";
}

$msg .= $dp;

if ($text != '')
{
    //$msg .= '<b style="color:' . $colorn . ';">MESSAGE: </b>'."\n".'<br/>' . nl2br($text) . '<br/>';
    $msg .= '<tr>' . "\n"
        . '<td ' . $std1 . '>' . "\n" . '<b>MESSAGE:</b>' . "\n" . '</td>' . "\n"
        . '<td ' . $std2 . '>' . nl2br($text) . '</td>' . "\n"
        . '</tr>' . "\n";
}

//$dp = '';
if (isset($_POST['dp']) && is_array($_POST['dp']))
{

    for ($x = 0; $x < count($_POST['dp']); $x++)
    {
        if (isset($_POST['dpn'][$x]))
        {
            $dpn = $_POST['dpn'][$x] . ":";
        }
        else
        {
            $dpn = '-';
        }
        //$msg .= '<b style="color:#0A0DA0;"> '.charset($dpn).' </b>'."\n".'' . nl2br(charset($_POST['dp'][$x])) . '<br/>';
        $msg .= '<tr>' . "\n"
            . '<td ' . $std1 . '>' . "\n" . '<b>' . charset($dpn) . '</b>' . "\n" . '</td>' . "\n"
            . '<td ' . $std2 . '>' . nl2br(charset($_POST['dp'][$x])) . '</td>' . "\n"
            . '</tr>' . "\n";
    }
}

$msg .= '</table>';
