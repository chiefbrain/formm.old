<?php

namespace App\Index;

use App\Add\Db;
use App\Model\DbConfigModel;
use App\Model\MailerConfigModel;

class Config
{
    /** @var array  */
    protected $app;

    public function __construct($root)
    {
//        $dbConf = (new DbConfigModel())
//            ->setCharset(DbConfigModel::DB_CHARSET_UTF8)
//            ->setDatabaseName('u10627ijf_formm')
//            ->setDatabaseType(DbConfigModel::DB_TYPE_MYSQL)
//            ->setPassword('TR4DBZJ5')
//            ->setServer('mysql2.justhost.ru')
//            ->setUsername('u10627ijf_oka');
        $dbConf = (new DbConfigModel())
            ->setCharset(DbConfigModel::DB_CHARSET_UTF8)
            ->setDatabaseName('formm')
            ->setDatabaseType(DbConfigModel::DB_TYPE_MYSQL)
            ->setPassword('secret')
            ->setServer('mariadb')
            ->setUsername('root');

        $mConf = (new MailerConfigModel())
            ->setServer('smtp.yandex.ru')
            ->setPassword('Qp8zUNiX')
            ->setLogin('mail@formm.ru')
            ->setPort(465)
            ->setSecure(MailerConfigModel::SECURE_SSL)
            ->setSender(null)
            ->setXMailer('Online service formm.ru');

        if (isset($_SERVER['HTTP_REFERER']))
            $ref = $_SERVER['HTTP_REFERER'];
        else
            $ref = "/";

        $this->app = [
            'db'          => new Db($dbConf),
            'root'        => $root,
            'defaultlang' => 'ru', // язык по умолчанию
            'main'        => 'base.html', // Указатель на главную
            'codeword'    => 'adminka', // Кодовое слово для админки
            'adminmain'   => 'pages', // Указатель на главную в админке
            'html'        => 'pages', //Указатель на компонент - обработчик html
            'REFERER'     => $ref,
            'ATPL'        => 'adminka', // шаблон админки
            'STPL'        => 'mouse_plus', // шаблон сайта
            'title'       => '', // 
            'descript'    => '', // 
            'keywords'    => '', //
            'TAB_ADMIN'   => 'form_admin', // таблица Админов
            'TAB_FUM'     => 'form_users_mail', // таблица пользоавтелей почтового сервиса.
            'TAB_BLOG'    => 'form_blog', // таблица 
            'TAB_COMM'    => 'form_comment', // таблица
            'mail'        => $mConf
//            'mail'        => [
//                'server'   => 'smtp.yandex.ru',
//                'port'     => 465,
//                'login'    => 'mail@formm.ru', // 'formm.ru@yandex.ru', //
//                'password' => 'Qp8zUNiX', // 'T2KUnJ', //
//                'secure'   => 'ssl', // null, tls, ssl,
//                'xMailer'  => 'Online service formm.ru', // null
//                'sender' => null,
//            ]
        ];
    }

    /**
     * @return array
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param array $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }


//    protected function getDB()
//    {
//        try
//        {
//            //$db = new Medoo($c->config->database);
//            $db = new \Medoo\Medoo([
//                'database_type' => 'mysql',
//                'database_name' => 'u10627ijf_formm', //'u10627ijf_antland',
//                'server'        => 'mysql2.justhost.ru',
//                'username'      => 'u10627ijf_oka', //'u10627ijf_ant',
//                'password'      => 'TR4DBZJ5', //'ip7o6QTS',
//                'charset'       => 'utf8',
//            ]);
//        }
//        catch (\Exception $e)
//        {
//            echo "fatal error database: " . $e->getMessage();
//        }
//        return $db;
//    }
}

/*
defined('PROTECT') or die('Restricted access');

ob_start("ob_gzhandler");

if (isset($_SERVER['HTTP_REFERER']))
    $ref = $_SERVER['HTTP_REFERER'];
else
    $ref = "/";
define('REFERER', $ref);

$ATPL = 'adminka';
$STPL = 'mouse_plus';


$GLOBALS['title'] = ''; //
$GLOBALS['descript'] = ''; // 
$GLOBALS['keywords'] = ''; // 


$GLOBALS['defaultlang'] = 'ru'; // язык по умолчанию
$GLOBALS['main'] = 'base.html'; // Указатель на главную
$GLOBALS['codeword'] = 'adminka'; // Кодовое слово для админки
$adminmain = 'pages'; // Указатель на главную в админке
$html = 'pages'; //Указатель на компонент - обработчик html
$separator = '-'; // или '/'

$AdminAccess = 5; // Право доступа к админке 

*/
/* Авто подгрузка классов из директории classes */
/* spl_autoload_register ('autoload');
  function autoload ($className)
  {
  include ROOT .'/classes/'.$className . '.php';
  } */
/* -------------------------------------------- */
