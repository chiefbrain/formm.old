<?php
defined('PROTECT') or die(include 'access.html');

use Medoo\Medoo;

/** @var Medoo $db */
$db = $app['db'];

$err = false;
$rep = '';

if (isset($_POST['next1'])) {
    $next = 1;
} else {
    if (isset($_POST['next2'])) {
        $next = 2;
    } else {
        $next = 0;
    }
}

$login = '';
$password = '';
$pass_dop = '';

if ($next != 2) {

    if (isset($_POST['name'])) {
        $_name = trim($_POST['name']);
        setcookie("name", $_name, time() + 3600);
    } else {
        if (isset($_COOKIE['name'])) {
            $_name = $_COOKIE['name'];
        }
    }

    if (isset($_POST['email'])) {
        $_email = trim($_POST['email']);
        setcookie("email", $_email, time() + 3600);
    } else {
        if (isset($_COOKIE['email'])) {
            $_email = $_COOKIE['email'];
        }
    }

    if (isset($_POST['link'])) {
        $__link = trim($_POST['link']);
        setcookie("link", $__link, time() + 3600);
    } else {
        if (isset($_COOKIE['link'])) {
            $__link = $_COOKIE['link'];
        }
    }

    $_link = str_replace(
        "https://", "", str_replace(
            "http://", "", str_replace(
                "https://www.", "", str_replace(
                    "http://www.", "", $__link
                )
            )
        )
    );

    if (substr($_link, -1) == '/') {
        $_link = substr($_link, 0, -1);
    }

    if ($_email != '' && $_link != '') {
        /* if ($password==$password2) { */
        $db_fum = $app['TAB_FUM'];

        if ( ! $db->has($db_fum, ['link' => $_link])) {
            if (isset($_POST['captcha'])) {
                $captcha = $_POST['captcha'];
            } else {
                $captcha = '';
            }

            if (isset($_SESSION['captcha_keybool'])) {
                $captcha_keybool = $_SESSION['captcha_keybool'];
            } else {
                $captcha_keybool = false;
            }

            if (isset($_SESSION['captcha_keystring'])
                && $_SESSION['captcha_keystring'] == $captcha
                || $captcha_keybool
            ) {
                $pos1 = false;
                if ($next != 1) {
                    $str = @file_get_contents($__link);

                    if ($str == '') {
                        $str = @file_get_contents('http://'.$_link);
                    }

                    if ($str == '') {
                        $str = @file_get_contents('https://'.$_link);
                    }

                    $pos1 = strpos($str, 'formm.ru/mail/');
                }

                if ($pos1 !== false || $next == 1) {
                    $sub = $db->get('subscription', '*', ['email' => $_email]);

                    $confirm = false;
                    $subject = '';
                    if (empty($sub)) {
                        $db->insert('subscription', [
                            'email' => $_email,
                            'confirm1' => date('Y-m-d H:i:s')
                        ]);
                        $confirm = true;
                        $subject = ', вам необходимо подтвердить подписку ➡';
                    }

                    if (empty($sub['subscribe'])) {
                        $db->update(
                            'subscription',
                            ['confirm1' => date('Y-m-d H:i:s')],
                            ['email' => $_email]
                        );

                        $confirm = true;
                        $subject = ', вам необходимо подтвердить подписку ➡';
                    }

                    if (empty($sub['unsubscribe'])) {
                        date_default_timezone_set('Europe/Moscow');

                        $DateTime = $db->raw('NOW()');
                        $db->insert(
                            $db_fum,
                            ['login'    => $login, 'password' => $password,
                             'pass_dop' => $pass_dop, 'name' => $_name,
                             'email'    => $_email, 'link' => $_link,
                             'DateTime' => $DateTime]
                        );

                        $data = [
                            'confirm'    => $confirm,
                            'user_name'  => $_name,
                            'user_email' => $_email,
                            'user_link'  => $_link,
                            'b64email'   => base64_encode($_email),
                            'subject'    => 'Регистрация на Formm.ru'.$subject,
                        ];

                        setcookie("name", "");
                        setcookie("email", "");
                        setcookie("link", "");
                        unset($_SESSION['captcha_keybool'], $_SESSION['captcha_keystring']);

                        include 'mail.php';
//                        $this->report(
//                            'Регистрация прошла успешно!', '/regs/', 'green'
//                        );
                    } else {
                        $this->report(
                            'Регистрация невозможна!<br>Вы уже отказались от нашей рассылки.', '/regs/', 'red', 10
                        );
                    }
                } else {
                    //echo "$_POST[captcha]=".$_POST['captcha']."<br/>"."$_SESSION[captcha_keystring]=".$_SESSION['captcha_keystring']."<br/>";
                    $_SESSION['captcha_keybool'] = true;
                    ?>

                    <div>
                        <div class="forma">
                            <div class="ftitle"><strong>Внимание !!!</strong>
                            </div>
                            <div class="forma2">

                                <div style="margin-top:10px;">На указанной Вами
                                    странице форма не найдена!<br/>Все равно
                                    продолжить регистрацию?
                                </div>
                                <div style="margin-top:10px; text-align:center;">

                                    <form method="post">
                                        <input class="button"
                                               style="width:155px;height:30px;"
                                               name="next1" type="submit"
                                               value="Да"/>
                                    </form>
                                    <form method="post">
                                        <input class="button"
                                               style="width:155px;height:30px;"
                                               name="next2" type="submit"
                                               value="Нет"/>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                $err = true;
                $rep = 'Ошибка в проверочном коде!';
            }
        } else {
            $err = true;
            $rep = 'Такой адрес формы уже зарегистрирован!';
        }
    } else {
        $err = true;
        $rep = 'Ошибка, необходимо заполнить все поля формы!';
    }
} else {
    unset($_SESSION['captcha_keybool'], $_SESSION['captcha_keystring']);
    $this->report('Отказ от регистрации!', '/regs/', 'red');
}

if ($err) {
    $this->report($rep, $app['REFERER'], 'red');
}


