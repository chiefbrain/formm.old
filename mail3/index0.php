<?php

ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки ))
echo '<pre>';
var_dump($_REQUEST);
var_dump($_SERVER);
echo '</pre>';
die;



/* formm.ru */
define('PROTECT', 1); //defined( 'PROTECT' ) or die( 'Restricted access' );
//$time_start = microtime(1); // Засекаем время

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


$conf = new \App\Index\Config(dirname(__FILE__));
$app = $conf->getApp();
$db = $app['db'];
$app['debug'] = new \App\Add\Debug($db);


if (isset($_POST['captcha']))
{
    $ref = str_replace(
        "https://", "", str_replace(
            "http://", "", str_replace(
                "https://www.", "", str_replace(
                    "http://www.", "", $_SERVER['HTTP_REFERER']
                )
            )
        )
    );

    $app['REFERER'] = $ref;

    //define('REFERER', str_replace('http://', '', str_replace('http://www.', '', $_SERVER['HTTP_REFERER'])));

    if (substr($app['REFERER'], -1) == '/')
        $ref = addslashes(substr($app['REFERER'], 0, -1));
    else
        $ref = addslashes($app['REFERER']);

    session_start();

    if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha'])
    {
        $db_fum = 'form_users_mail';
        //include dirname(__FILE__) . '/connect.php';
        //$res = mysql_query("SELECT * FROM $db_fum WHERE link='$ref' LIMIT 1");
        //if (mysql_num_rows($res))
        $res = $db->get($db_fum, '*', [link => $ref]);
        if (!empty($res))
        {
            $row = $res;
            $id = $row['id'];
            $to = $row['email']; //'svs@glevix.ru';
            $kolvo = $row['kolvo'];

            // Была непонятная ошибка при отправке с этого адреса ???!!!
            /*
              if ($to == '80990160390@mail.ru')
              {

              ob_start();

              print_r($_POST);

              $myPost = ob_get_contents();

              file_put_contents('000.txt', $myPost);
              }
             */
            $mailDomen = strtolower(substr($to, strrpos($to, '@') + 1));

            //include 'a.charset.php';

            function charset($str)
            {
                if (isset($_POST['charset']))
                {
                    $chars = $_POST['charset'];
                    if ($chars == 'UTF-8' || $chars == 'utf-8' || $chars == 'UTF8' || $chars == 'utf8')
                    {
                        $otv = $str;
                    }
                    else
                    {
                        $otv = iconv($chars, "UTF-8", $str);
                    }
                }
                else
                {
                    $charset = new \App\Add\Acharset();
                    $otv = $charset->charset_x_utf($str);
                }

                return $otv;
            }

            if (isset($_POST['name']))
                $name = charset($_POST['name']);
            else
                $name = '';
            if (isset($_POST['text']))
                $text = charset($_POST['text']);
            else
                $text = '';
            if (isset($_POST['email']))
                $email = $_POST['email'];
            else
                $email = '';

            //if (isset($_POST['to'])) $to=$_POST['to']; else $to='';
            // Цвет названия поля в письме
            if (isset($_POST['colorn']))
            {
                $colorn = $_POST['colorn'];
            }
            else
            {
                $colorn = 'green'; //'#0A0DA0';
            }

            /*             * **************************************************************** */

            $stopEmail = file('StopEmail.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (in_array($email, $stopEmail))
            {
                otvet('<p style="color: blue;">Сообщение отправлено</p>', true);
                //die;
            }

            $stopWorld = file('StopWorld.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($stopWorld as $stopW)
            {
                if (mb_strpos($text, trim($stopW)) !== false)
                {
                    otvet('<p style="color: blue;">Сообщение отправлено</p>', true);
                    //die;
                }
            }

            // Защита от мошейников !!!
            $stopSites = [
                "smsturum.ru",
                "zaim-card.io.ua"
            ];
            foreach ($stopSites as $stopS)
            {
                if (mb_strpos($app['REFERER'], $stopS) === 0)
                {
                    /*
                      mysql_query("INSERT INTO `anti_deception` (
                      recipient, link, sender
                      ) VALUES (
                      '$to','$ref','$email'
                      )");
                     */
                    $db->insert('anti_deception', ['recipient' => $to, 'link' => $ref, 'sender' => $email]);
                    otvet('<p style="color: blue;">Сообщение отправлено</p>', true);
                }
            }

            /*             * **************************************************************** */

            $md = [
                'mail.ru' => 1,
                'inbox.ru' => 1,
                'list.ru' => 1,
                'bk.ru' => 1,
            ];

            // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $eee = strtolower(substr($email, strrpos($email, '@') + 1));

            if (isset($_POST['textonly']))
            {
                $msg = $text;
            }
            else
            {

                // Стиль td таблицы
                $std1 = 'style="width:160px;padding:5px;vertical-align:top;text-align:right;color:' . $colorn . ';"';
                $std2 = 'style="padding: 5px; vertical-align: top;"';

                if (isset($_POST['dp3']))
                    $p[] = $_POST['dp3'];
                if (isset($_POST['dp4']))
                    $p[] = $_POST['dp4'];
                if (isset($_POST['dp5']))
                    $p[] = $_POST['dp5'];
                if (isset($_POST['dp6']))
                    $p[] = $_POST['dp6'];
                if (isset($_POST['dp7']))
                    $p[] = $_POST['dp7'];
                if (isset($_POST['dp8']))
                    $p[] = $_POST['dp8'];

                $dp = '';
                if (isset($p))
                {
                    foreach ($p as $pp)
                    {
                        if ($pp != '')
                        {
                            //$dp .= $pp . '<br/>' . "\n";
                            $dp .= '<tr>' . "\n"
                                . '<td ' . $std1 . '>' . "\n" . '<b>-</b>' . "\n" . '</td>' . "\n"
                                . '<td ' . $std2 . '>' . charset($pp) . '</td>' . "\n"
                                . '</tr>' . "\n";
                        }
                    }
                    //$dp = charset($dp);
                }

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
            }

            //if (!preg_match("/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,4}$/", $email)) $email='--@--.--';

            if (isset($_POST['subject']) && $_POST['subject'] != '')
            {
                $subject = charset($_POST['subject']);
            }
            else
            {
                $subject = 'Сообщение со страницы: ' . $app['REFERER']; //
            }

            // Конфиг для инициализации класса
            $conf = $app['mail'];
            $realFrom = 'mail@formm.ru'; // От кого "реальный адрес"
            /*
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try
                        {
                            //Server settings
                            $mail->SMTPDebug  = 2;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host       = $conf['server'];  // Specify main and backup SMTP servers
                            $mail->SMTPAuth   = true;                               // Enable SMTP authentication
                            $mail->Username   = $conf['login'];                 // SMTP username
                            $mail->Password   = $conf['password'];                           // SMTP password
                            $mail->SMTPSecure = $conf['secure'];                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port       = $conf['port'];                                    // TCP port to connect to
                            $mail->XMailer    = $conf['xMailer'];
                            $mail->Sender     = $from;
                            //Recipients
                            $mail->setFrom($realFrom);
                            //$mail->setFrom('from@example.com', 'Mailer');
                            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                            //$mail->addAddress('ellen@example.com');               // Name is optional
                            $mail->addAddress($to);
                            //$mail->addReplyTo($from, '!!!');
                            //$mail->addReplyTo('info@example.com', 'Information');
                            //$mail->addCC('cc@example.com');
                            //$mail->addBCC('bcc@example.com');

                            //Attachments
                            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            //Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = $subject;
                            $mail->Body    = $msg; // 'This is the HTML message body <b>in bold!</b>';
                            //$mail->AltBody = strip_tags();//'This is the body in plain text for non-HTML mail clients';

                            $mail->send();
                            //echo 'Message has been sent';
                            //if ($mail->send($realFrom, $from, $to, $subject, $msg))

                            otvet('<p style="color:green;">Сообщение отправлено</p>', true);


                        }
                        catch (Exception $e)
                        {
                            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                            //otvet('<p style="color:red;">Что то пошло не так!<br/>Сообщение НЕ отправлено!</p>');

                            ob_start();
                            print_r($mail->ErrorInfo);
                            $err = ob_get_contents();

                            otvet('<pre>'.$err.'</pre>');
                        }
            */

            //$config['senderName'] = $senderName; // $name ,//. ' <' . $email . '>', //'FORMM.RU', // null
            // Сама инициализация (нужно вызвать только один раз), вернет класс для работы с SMTP-сервером

            $mail = init($conf);
            /*
              ob_start();
              print_r($_POST);
              $lll = ob_get_contents();

              otvet('!!!<br><pre>' . $lll . '</pre>');
             */
            // Если не залогинились - echo, иначе отправляем письмо с аттачем
            if (!$mail->isLogin)
            {
                otvet('<p style="color:red;">Ошибка SMTP!<br/>Попробуйте отправить сообщение позже.</p>');
            }
            else
            {

                // Добавляем аттач к письму
                if (isset($_FILES))
                {

                    foreach ($_FILES as $att)
                    {
                        $f_name = $att['name'];
                        $f_type = $att['type'];
                        $f_tmp_name = $att['tmp_name'];
                        $f_error = $att['error'];
                        $f_size = $att['size'];

                        if (is_array($f_error))
                        {
                            for ($x = 0; $x < count($f_error); $x++)
                            {
                                if ($f_error[$x] == 0)
                                {

                                    $mail->addAttachment($f_tmp_name[$x], $f_name[$x]);
                                }
                            }
                        }
                        else
                        {
                            if ($f_error == 0)
                            {
                                $mail->addAttachment($f_tmp_name, $f_name);
                            }
                        }
                    }
                }

                //===============================================================
                $realFrom = 'mail@formm.ru'; // От кого "реальный адрес"
                //===============================================================
                /* if ($domen == 'mail.ru')
                  {
                  $from = 'mail@formm.ru'; // От кого
                  }
                  else
                  { */

                //}
                //$to   = $to; //'oblnn@yandex.ru'; // Кому
                //$subj = $subject; // Тема письма
                //$body = $text; // Тело письма*/

                if (isset($md[$mailDomen]) || isset($md[$eee]))
                {
                    $mail->senderName = $name . ' <' . $email . '>';
                    $from = $realFrom;
                    //$_MD        = true;
                }
                else
                {
                    $mail->senderName = $name; // null
                    $from = $email; // От кого null; //
                    //$_MD        = false;
                }

                /* $mail->send(from, to, subject, body, headers = optional) */
                // $realFrom, $from, $to, $subject, $message, $headers = null
                //ob_start();
                //echo $sotv;
                //$lll = ob_get_contents();
                //if ($mail->send($_MD, $realFrom, $from, $to, $subject, $msg))
                if ($mail->send($realFrom, $from, $to, $subject, $msg))
                {

                    // Очищаем все аттачи для последующих отправок, использующих этот же инстанс класса работы с SMTP-сервером
                    $mail->clearAttachments();

                    // Увеличиваем счетчик
                    $kolvo++;
                    //mysql_query("UPDATE $db_fum SET kolvo='$kolvo' WHERE id=$id");
                    $db->update($db_fum, ['kolvo' => $kolvo], ['id' => $id]);
                    $app['debug']->db();
                    //define('BACK', 1);
                    otvet('<p style="color:green;">Сообщение отправлено</p>', true);
                }
                else
                {
                    file_put_contents('ServerResponse.txt', $mail->ServerResponse);

                    otvet('<p style="color:red;">Что то пошло не так!<br/>Сообщение НЕ отправлено!</p>');
                }
            }
        }
        else
            otvet('<p style="color:red;">Ошибка!<br/>Адрес: "' . $app['REFERER'] . '" не зарегистрирован в системе.<br/><a href="/regs/">Зарегистрируйтесь</a></p>'); // неправильный реферер.
    }
    else
        otvet('<p style="color:red;">Ошибка в проверочном коде</p>');

    unset($_SESSION['captcha_keystring']);
    session_destroy();
}
else
    otvet('<p>Ваше рекламное место!</p><a href="/">на главную</a>');


// Инициализация класса работы с SMTP-сервером
function init($serverConfig)
{
    //include_once('km_smtp_class.php');

    $mail = new \App\Add\KMMailer($serverConfig['server'], $serverConfig['port'], $serverConfig['login'], $serverConfig['password'], $serverConfig['secure']);
    $mail->xMailer = $serverConfig['xMailer'];
    //$mail->senderName = $serverConfig['senderName'];

    return $mail;
}


function otvet($message, $b = null)
{
    if ($b)
        $blink = 'window.location.href="' . $_SERVER['HTTP_REFERER'] . '";';
    else
        $blink = 'history.back();';

    if (isset($_POST['message']) && $_POST['message'] != '')
        $message = $_POST['message'];

    if (isset($_POST['return_message']) && $_POST['return_message'] != '')
    {
        $return_message = $_POST['return_message'];
    }
    else
    {
        $return_message = "Вернетесь назад через %t cек.";
    }

    if (isset($_POST['return_time']) && $_POST['return_time'] != '')
    {
        $return_time = $_POST['return_time'];
    }
    else
    {
        $return_time = 15;
    }
    if (isset($_POST['back_button']) && $_POST['back_button'] != '')
    {
        $back_button = $_POST['back_button'];
    }
    else
    {
        $back_button = "<- Вернуться назад";
    }

    include 'otvet.php';
    die();
}
