<?php

defined('PROTECT') or die(include 'access.html');

require ROOT . '/mail/a.charset.php';
//base64_encode
$text    = charset_x_win($_name) . '<br/>' . $_email . '<br/><a href="http://www.' . $_link . '">' . $_link . '</a>';
$_name   = '=?windows-1251?Q?' . str_replace("+", "_", str_replace("%", "=", urlencode($_name))) . '?=';
$subject = '=?windows-1251?Q?' . str_replace("+", "_", str_replace("%", "=", urlencode('Регистрация на formm.ru'))) . '?=';

$ok = 0;

$to = 'svs@glevix.ru';

$data   = data($_name, $_email, $to, $subject, $text, $fname, $tname);
/*
  $server='smtp.yandex.ru';
  $login ='oblnn@yandex.ru';
  $passw ='X(87gVNQKBFT095m';
  $from=' <oblnn@yandex.ru>';
  $ok=smail( $server,$login,$passw, $to, $from, $data);

  if (!$ok) { */
$server = 'mail.templat.ru';
$login  = 'user2700';
$passw  = 'twWOmMMLYMbTyr27';
$from   = ' <user2700@templat.ru>';
$ok     = smail($server, $login, $passw, $to, $from, $data);
//}

if (!$ok)
{
    $server = 'smtp.formm.ru'; //'localhost';
    $login  = 'mail@formm.ru';
    $passw  = 'bqmqo2cX';
    $from   = ' <mail@formm.ru>';
    $ok     = smail($server, $login, $passw, $to, $from, $data);
}

/* if (!$ok) {
  $server='freemail.centre.ru';
  $login ='form@webservis.ru';
  $passw ='Kthbr';
  $from=' <form@webservis.ru>';
  $ok=smail( $server,$login,$passw, $to, $from, $data);
  } */

/* if (!$ok) {
  otvet ('Ошибка SMTP !<br/>Попробуйте отправить сообщение позже.');
  } */

function smail($server, $login, $passw, $to, $from, $data)
{
    $c        = fsockopen($server, 25, $errno, $errstr, 30);
    $smtp_err = 1;
    if (!$c)
    {
        $smtp_err = 0;
        $gd       = 'Ошибка SMTP ' . "$errstr ($errno)" . '<br/><br/>Попробуйте отправить сообщение позже.';
    }
    else
    {
        $gd = get_data($c);

        if ($gd < 400)
        {
            fputs($c, "EHLO $server\r\n");
            $gd = get_data($c);

            if ($gd < 400)
            {
                fputs($c, "AUTH LOGIN\r\n");
                $gd = get_data($c);

                if ($gd < 400)
                {
                    fputs($c, base64_encode($login) . "\r\n");
                    $gd = get_data($c);

                    if ($gd < 400)
                    {
                        fputs($c, base64_encode($passw) . "\r\n");
                        $gd = get_data($c);

                        if ($gd < 400)
                        {
                            fputs($c, "MAIL FROM: $from\r\n");
                            $gd = get_data($c);
                            if ($gd < 400)
                            {
                                fputs($c, "RCPT TO: $to\r\n");
                                $gd = get_data($c);
                                if ($gd < 400)
                                {
                                    fputs($c, "DATA\r\n");
                                    $gd = get_data($c);
                                    if ($gd < 400)
                                    {
                                        fputs($c, $data . "\r\n.\r\n");
                                        $gd = get_data($c);
                                        if ($gd < 400)
                                        {
                                            fputs($c, "QUIT\r\n");
                                            $gd       = get_data($c);
                                            if ($gd > 400)
                                                $smtp_err = 0;
                                        }
                                        else
                                            $smtp_err = 0;
                                    }
                                    else
                                        $smtp_err = 0;
                                }
                                else
                                    $smtp_err = 0;
                            }
                            else
                                $smtp_err = 0;
                        }
                        else
                            $smtp_err = 0;
                    }
                    else
                        $smtp_err = 0;
                }
                else
                    $smtp_err = 0;
            }
            else
                $smtp_err = 0;
        }
        else
            $smtp_err = 0;
    }
    //if (!$smtp_err) otvet ('Ошибка SMTP '.$gd.'<br/><br/>Попробуйте отправить сообщение позже.');
    fclose($c);
    return $smtp_err;
}

function get_data($smtp_conn)
{
    $time_start = microtime(1);
    while ($str        = fgets($smtp_conn))
    {
        if ($str != '')
            break;
        if ((microtime(1) - $time_start) > 10)
        {
            $str = 600;
            break;
        }
    }
    //if (substr($str,0,3)<400) $ret=1; else $ret=0;
    //echo substr($str,0,3).'<br/>';
    return substr($str, 0, 3);
}

//function ncode ($c) { return str_replace("+","_",str_replace("%","=",urlencode($c))); }

function data($_name, $_email, $to, $subject, $text, $filename, $tmp_name)
{
    $d = '';
    $un = '----------' . strtoupper(uniqid(time()));
    //$d = "Date: ".date("D M j G:i:s Y")."+0700\r\n";
    //$d = "Date: ".date("D, j M Y G:i:s")." +0700\r\n"; 
    $d.= "From: " . $_name . " <" . $_email . ">\r\n"; //От кого
    $d.= "X-Mailer: The Bat! (v3.99.3) Professional\r\n"; //Почтовый агент
    $d.= "Reply-To: " . $_name . " <" . $_email . ">\r\n"; //Обратный e-mail
    $d.= "X-Priority: 3 (Normal)\r\n";
    $d.= "Message-ID: <172562218." . date("YmjHis") . "@formm.ru>\r\n";
    $d.= "To: <$to>\r\n"; //Кому
    $d.= "Subject: $subject\r\n"; //Тема
    if ($filename != '')
    {
        $d.= "Mime-Version: 1.0\r\n";
        $d.= "Content-Type:multipart/mixed;";
        $d.= "boundary=" . $un . "\r\n\r\n";
        $d.= "--" . $un . "\r\n";
    }
    $d.= "Content-Type:text/html;charset=windows-1251\r\n"; //charset=windows-1251 charset=utf-8
    $d.= "Content-Transfer-Encoding: 8bit\r\n\r\n$text\r\n\r\n";
    if ($filename != '')
    {
        $d.= "--" . $un . "\r\n";
        $d.= "Content-Type: application/octet-stream;";
        $d.= "name=\"$filename\"\r\n";
        $d.= "Content-Transfer-Encoding:base64\r\n";
        $d.= "Content-Disposition:attachment;";
        $d.= "filename=\"$filename\"\r\n\r\n";
        $d.= chunk_split(base64_encode(file_get_contents($tmp_name))) . "\r\n";
    }
    return $d;
}

?>