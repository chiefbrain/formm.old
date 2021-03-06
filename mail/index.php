<?php

use Medoo\Medoo;

ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки ))

/* formm.ru */
define('PROTECT', 1); //defined( 'PROTECT' ) or die( 'Restricted access' );
//$time_start = microtime(1); // Засекаем время

use App\Model\MailerConfigModel;
use App\Add\GeneralMailer;
use App\Model\MailerSendModel;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$conf = new \App\Index\Config(dirname(__FILE__));
$app = $conf->getApp();

/** @var Medoo $db */
$db = $app['db'];
$app['debug'] = new \App\Add\Debug($db);


if (isset($_POST['captcha'])) {
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

    if (substr($app['REFERER'], -1) == '/') {
        $ref = addslashes(substr($app['REFERER'], 0, -1));
    } else {
        $ref = addslashes($app['REFERER']);
    }

    session_start();

    if (isset($_SESSION['captcha_keystring'])
        && $_SESSION['captcha_keystring'] == $_POST['captcha']
    ) {
        $db_fum = 'form_users_mail';
        //include dirname(__FILE__) . '/connect.php';
        //$res = mysql_query("SELECT * FROM $db_fum WHERE link='$ref' LIMIT 1");
        //if (mysql_num_rows($res))
        $res = $db->get($db_fum, '*', ['link' => $ref]);
        if (!empty($res)) {
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
                if (isset($_POST['charset'])) {
                    $chars = $_POST['charset'];
                    if ($chars == 'UTF-8' || $chars == 'utf-8'
                        || $chars == 'UTF8'
                        || $chars == 'utf8'
                    ) {
                        $otv = $str;
                    } else {
                        $otv = iconv($chars, "UTF-8", $str);
                    }
                } else {
                    $charset = new \App\Add\Acharset();
                    $otv = $charset->charset_x_utf($str);
                }

                return $otv;
            }

            if (isset($_POST['name'])) {
                $name = charset($_POST['name']);
            } else {
                $name = '';
            }
            if (isset($_POST['text'])) {
                $text = charset($_POST['text']);
            } else {
                $text = '';
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $email = '';
            }

            if (!preg_match("/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,4}$/", $email)) {
                otvet(
                    '<p style="color:red;">Отправка сообщения невозможна, вы указали неправильный email</p>'
                );
            }

            //if (isset($_POST['to'])) $to=$_POST['to']; else $to='';
            // Цвет названия поля в письме
            if (isset($_POST['colorn'])) {
                $colorn = $_POST['colorn'];
            } else {
                $colorn = 'green'; //'#0A0DA0';
            }

            /** **************************************************************** */

            $stopEmail = file(
                'StopEmail.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
            );

            if (in_array($email, $stopEmail)) {
                otvet('<p style="color: blue;">Сообщение отправлено</p>', true);
                //die;
            }

            $stopWorld = file(
                'StopWorld.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
            );

            foreach ($stopWorld as $stopW) {
                if (mb_strpos($text, trim($stopW)) !== false) {
                    otvet(
                        '<p style="color: blue;">Сообщение отправлено</p>', true
                    );
                    //die;
                }
            }

            // Защита от мошейников !!!
            $stopSites = [
                "smsturum.ru",
                "zaim-card.io.ua",
            ];
            foreach ($stopSites as $stopS) {
                if (mb_strpos($app['REFERER'], $stopS) === 0) {
                    /*
                      mysql_query("INSERT INTO `anti_deception` (
                      recipient, link, sender
                      ) VALUES (
                      '$to','$ref','$email'
                      )");
                     */
                    $db->insert(
                        'anti_deception',
                        ['recipient' => $to, 'link' => $ref, 'sender' => $email]
                    );
                    otvet(
                        '<p style="color: blue;">Сообщение отправлено</p>', true
                    );
                }
            }

            /*             * **************************************************************** */

            $md = [
                'mail.ru'  => 1,
                'inbox.ru' => 1,
                'list.ru'  => 1,
                'bk.ru'    => 1,
            ];

            // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $eee = strtolower(substr($email, strrpos($email, '@') + 1));


            //            if (isset($_POST['subject']) && $_POST['subject'] != '')
//            {
//                $subject = charset($_POST['subject']);
//            }
//            else
//            {
//                $subject = 'Сообщение со страницы: ' . $app['REFERER']; //
//            }

            /** START ПРОВЕРКА ПОДПИСКИ */

            $sub = $db->get('subscription', '*', ['email' => $to]);

            if (empty($sub)) {
                otvet(
                    '<p style="color:red;">Ошибка 1000<br/>Попробуйте отправить сообщение позже.</p>'
                );
            }

            if (!empty($sub['unsubscribe']) || $sub['ban']) {
                otvet(
                    '<p style="color:blue;">Отправка сообщения невозможна, владелец email отказался от рассылки</p>'
                );
            }

            if (empty($sub['subscribe']) && !empty($sub['confirm1'])) {
                otvet(
                    '<p style="color:blue;">Отправка сообщения невозможна, владелец email не подтвердил подписку на рассылку</p>'
                );
            }

            $tpl = __DIR__ . '/view/subscribe.php';
            $subject = 'Formm.ru сообщение';

            if (empty($sub['subscribe']) && empty($sub['confirm1'])) {
                $db->update(
                    'subscription',
                    ['confirm1' => date('Y-m-d H:i:s')],
                    ['email' => $to]
                );
                $tpl = __DIR__ . '/view/confirm.php';
                $subject .= ', вам необходимо подтвердить подписку ➡';
            }

            /** END ПРОВЕРКА ПОДПИСКИ */

//            if (isset($_POST['textonly']))
//            {
//                $msg = $text;
//            }
//            else
//            {

            // Стиль td таблицы
            $std1
                = 'style="width:160px;padding:5px;vertical-align:top;text-align:right;color:'
                . $colorn . ';"';
            $std2 = 'style="padding: 5px; vertical-align: top;"';

            if (isset($_POST['dp3'])) {
                $p[] = $_POST['dp3'];
            }
            if (isset($_POST['dp4'])) {
                $p[] = $_POST['dp4'];
            }
            if (isset($_POST['dp5'])) {
                $p[] = $_POST['dp5'];
            }
            if (isset($_POST['dp6'])) {
                $p[] = $_POST['dp6'];
            }
            if (isset($_POST['dp7'])) {
                $p[] = $_POST['dp7'];
            }
            if (isset($_POST['dp8'])) {
                $p[] = $_POST['dp8'];
            }

            $dop = '';
            if (isset($p)) {
                foreach ($p as $pp) {
                    if ($pp != '') {
                        $dop .= '<div>' . $pp . '</div>';
                    }
                }
                $dop = charset($dop);
            }

            $data = [
                'name'     => $name,
                'email'    => $email,
                'text'     => nl2br($text),
                'dop'      => $dop,
                'b64email' => base64_encode($to),
            ];

            ob_start();
            require $tpl;
            $msg = ob_get_clean();
//            }

            // Конфиг для инициализации класса
            /** @var MailerConfigModel $conf */
            $conf = $app['mail'];

            // Сама инициализация
//            $mail = init($conf);
            $mail = new GeneralMailer($conf);


            /*
              ob_start();
              print_r($_POST);
              $lll = ob_get_contents();

              otvet('!!!<br><pre>' . $lll . '</pre>');
             */
            // Если не залогинились - echo, иначе отправляем письмо с аттачем
//            if ( ! $mail->isLogin) {
            if ($mail->getException() !== null) {
                otvet(
                    '<p style="color:red;">'
                    . 'Ошибка SMTP!<br/>'
                    . 'Попробуйте отправить сообщение позже.<br/>'
                    . $mail->getException()->getMessage()
                    . '</p>'
                );
            } else {

                // Добавляем аттач к письму
                if (isset($_FILES)) {

                    foreach ($_FILES as $att) {
                        $f_name = $att['name'];
                        $f_type = $att['type'];
                        $f_tmp_name = $att['tmp_name'];
                        $f_error = $att['error'];
                        $f_size = $att['size'];

                        if (is_array($f_error)) {
                            for ($x = 0; $x < count($f_error); $x++) {
                                if ($f_error[$x] == 0) {

                                    $mail->addAttachment(
                                        $f_tmp_name[$x], $f_name[$x]
                                    );
                                }
                            }
                        } else {
                            if ($f_error == 0) {
                                $mail->addAttachment($f_tmp_name, $f_name);
                            }
                        }
                    }
                }

                //===============================================================
//                $realFrom = 'mail@formm.ru'; // От кого "реальный адрес"
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

                /** ************************************************************/
                /** Всегда используем реальный email !!! или нет ??? !!! */
//                if (isset($md[$mailDomen]) || isset($md[$eee]))
//                {
//                $mail->senderName = $name.' <'.$email.'>';
//                $from = $realFrom;
                //$_MD        = true;
//                }
//                else
//                {
//                    $mail->senderName = $name; // null
//                    $from = $email; // От кого null; //
//                    //$_MD        = false;
//                }
                /** ************************************************************/

                /* $mail->send(from, to, subject, body, headers = optional) */
                // $realFrom, $from, $to, $subject, $message, $headers = null
                //ob_start();
                //echo $sotv;
                //$lll = ob_get_contents();
                //if ($mail->send($_MD, $realFrom, $from, $to, $subject, $msg))

                $realFrom = $conf->getLogin();

                /** 13.03.2019 22:48 */
                $from = $conf->getLogin(); // '=?utf-8?b?' . base64_encode($name) . '?='; // $email; //

//                $mail->setReplyTo($email);
//
//                if ($mail->send($realFrom, $from, $to, $subject, $msg)) {

                $sendConf = (new MailerSendModel())
                    ->setReplyTo($email)
                    ->setRealFrom($conf->getLogin())
                    ->setFrom($conf->getLogin())
                    ->setTo($to)
                    ->setSubject($subject)
                    ->setMsg($msg);


                if ($mail->send($sendConf)) {
                    // Очищаем все аттачи для последующих отправок, использующих этот же инстанс класса работы с SMTP-сервером
//                    $mail->clearAttachments();

                    // Увеличиваем счетчик
                    $kolvo++;
                    //mysql_query("UPDATE $db_fum SET kolvo='$kolvo' WHERE id=$id");
                    $db->update($db_fum, ['kolvo' => $kolvo], ['id' => $id]);
                    $app['debug']->db();
                    //define('BACK', 1);

//                    $content = date('d.m.Y H:i') . ' | ' . $to . ' | '
//                        . $mail->ServerResponse;
//                    file_put_contents(
//                        'ServerResponse.txt', $content, FILE_APPEND
//                    );

                    otvet(
                        '<p style="color:green;">Сообщение отправлено</p>', true
                    );
                } else {

                    $errMsg = $mail->getException()->getMessage();
                    $log = date('d.m.Y H:i') . ' | ' . $to . ' | ' . $errMsg;
                    file_put_contents(
                        'ServerResponse.txt', $log, FILE_APPEND
                    );

                    otvet(
                        '<p style="color:red;">' . $errMsg . '</p>'
                    );

//                    otvet(
//                        '<p style="color:red;">Что то пошло не так!<br/>Сообщение НЕ отправлено!</p>'
//                    );
                }
            }
        } else {
            otvet(
                '<p style="color:red;">Ошибка!<br/>Адрес: "' . $app['REFERER']
                . '" не зарегистрирован в системе.<br/><a href="/regs/">Зарегистрируйтесь</a></p>'
            );
        } // неправильный реферер.
    } else {
        otvet('<p style="color:red;">Ошибка в проверочном коде</p>');
    }

    unset($_SESSION['captcha_keystring']);
    session_destroy();
} else {
    otvet('<p>Ваше рекламное место!</p><a href="/">на главную</a>');
}


// Инициализация класса работы с SMTP-сервером
function init($serverConfig)
{
    //include_once('km_smtp_class.php');

    $mail = new \App\Add\KMMailer(
        $serverConfig['server'], $serverConfig['port'], $serverConfig['login'],
        $serverConfig['password'], $serverConfig['secure']
    );
    $mail->xMailer = $serverConfig['xMailer'];

    //$mail->senderName = $serverConfig['senderName'];

    return $mail;
}


function otvet($message, $b = null)
{
    if ($b) {
        $blink = 'window.location.href="' . $_SERVER['HTTP_REFERER'] . '";';
    } else {
        $blink = 'history.back();';
    }

    if (isset($_POST['message']) && $_POST['message'] != '') {
        $message = $_POST['message'];
    }

    if (isset($_POST['return_message']) && $_POST['return_message'] != '') {
        $return_message = $_POST['return_message'];
    } else {
        $return_message = "Вернетесь назад через %t cек.";
    }

    if (isset($_POST['return_time']) && $_POST['return_time'] != '') {
        $return_time = $_POST['return_time'];
    } else {
        $return_time = 15;
    }
    if (isset($_POST['back_button']) && $_POST['back_button'] != '') {
        $back_button = $_POST['back_button'];
    } else {
        $back_button = "<- Вернуться назад";
    }

    include __DIR__ . '/view/otvet.php';
    die();
}
