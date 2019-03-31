<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 04.12.18
 * Time: 23:34
 */

namespace App\Mail;

use App\App;
use App\Add\Acharset;
use App\Add\KMMailer;

class Functions
{
    /** @var App */
    private $app;

    /**
     * Functions constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function getRecord()
    {
        /** @var App $app */
        $app = $this->app;
        $db_fum = 'form_users_mail';
        $rec = $app
            ->getDb()
            ->get($db_fum, ['id', 'email'], ['link' => $this->getDbLink()]);

        $res = [
            'error' => true,
            'msg'   => 'Ошибка!<br/>Адрес: "' . $app->getReferer()
                . '" не зарегистрирован в системе.'
        ];

        if (count($rec) > 0) {
            $res = [
                'error' => false,
                'data'  => $rec
            ];
        }

        return $res;
    }

    public function getDbLink()
    {
        $ref = $this->getApp()->getReferer();
        $pos = strpos($ref, ':');
        $res = substr($ref, $pos, 7);

        $off = ($res == '://www.') ? 7 : 3;
        $lnk = substr($ref, $pos + $off);

        if (substr($lnk, -1) == '/') {
            $lnk = substr($lnk, 0, -1);
        }

        return addslashes($lnk);
    }

    function charset($str)
    {
        $otv = $str;

        $_chars = isset($_POST['charset']) ? $_POST['charset'] : null;
        $chars = mb_strtolower(str_replace(['-', ' '], '', $_chars));

        if ($chars != null && $chars != 'utf8') {
            $otv = iconv($chars, "UTF-8", $str);
        }

        if ($chars == null) {
            $charset = new Acharset();
            $otv = $charset->charset_x_utf($str);
        }

        return $otv;
    }

    public function parseFormV1()
    {
        $app = $this->getApp();
        $post = $app->getPost();

        $conf = [
            'colorn'   => 'green', // Цвет названия поля в письме
            'textonly' => false,
            'warning'  => 'on' // off - выключение предупреждения
        ];

        foreach ($conf as $i => $v) {
            if (isset($post[$i])) {
                $conf[$i] = $post[$i];
            }
        }

        $base = [
            'name'    => '',
            'text'    => '',
            'subject' => 'Сообщение со страницы: ' . $app->getReferer()
        ];

        foreach ($base as $i => $v) {
            if (isset($post[$i])) {
                $dop[$i] = $this->charset($post[$i]);
            }
        }

        $base['email'] = isset($post['email']) ? $post['email'] : '';

        $dop = [];

        if ($conf['textonly'] == false) {
            $dopFields = ['dp3', 'dp4', 'dp5', 'dp6', 'dp7', 'dp8'];

            foreach ($dopFields as $dopf) {
                if (isset($post[$dopf])) {
                    $dop[$dopf] = $this->charset($post[$dopf]);
                }
            }
        }

        return [
            'conf' => $conf,
            'base' => $base,
            'dop'  => $dop
        ];
    }

    public function parseFormV2()
    {
        $res = [];

        if (isset($_POST['dp']) && is_array($_POST['dp'])) {

            foreach ($_POST['dp'] as $i => $v) {

                $res[] = [
                    'label' => isset($_POST['dpn'][$i]) ? $_POST['dpn'][$i]
                        : '-',
                    'value' => $v
                ];
            }
        }

        return $res;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    public function setAttach(Mailer $mailer)
    {
        $files = $this->getApp()->getFiles();

        // Добавляем аттач к письму
        if (isset($files)) {

            foreach ($files as $f) {
                $f_name = $f['name'];
                $f_type = $f['type'];
                $f_tmp_name = $f['tmp_name'];
                $f_error = $f['error'];
                $f_size = $f['size'];

                if (is_array($f_error)) {
                    for ($x = 0; $x < count($f_error); $x++) {
                        if ($f_error[$x] == 0) {

                            $mailer->addAttachment(
                                $f_tmp_name[$x], $f_name[$x]
                            );
                        }
                    }
                } else {
                    if ($f_error == 0) {
                        $mailer->addAttachment($f_tmp_name, $f_name);
                    }
                }
            }
        }
    }

    public function checkCaptcha()
    {

        return (
            isset($_POST['captcha'], $_COOKIE['CAPTCHAHASH'])
            && password_verify(
                $_POST['captcha'], $_COOKIE['CAPTCHAHASH']
            )
        );
    }

}