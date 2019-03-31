<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 13.12.18
 * Time: 23:07
 */

namespace App\Mail;


class Config
{
    private $server;
    private $port;
    private $login;
    private $password;
    private $secure;
    private $xMailer;


    public function __construct()
    {
        $this->server = 'smtp.yandex.ru';
        $this->port = 465;
        $this->login = 'mail@formm.ru';
        $this->password = 'Qp8zUNiX';
        $this->secure = 'ssl'; // null, tls, ssl,
        $this->xMailer = 'Online service formm.ru'; // null'
    }
}