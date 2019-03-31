<?php

// Авторизация

namespace App\Index;

class Authorize {

    protected $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getSession() {
        session_start();
        $session = [];
        
        if (isset($_SESSION['admin'])) {
            define('ADMIN', 1); //defined( 'ADMIN' ) or die( 'Restricted access' );
            $session['ADMIN'] = true;
            $session['admin'] = $_SESSION['admin'];
            $session['admininfo'] = $_SESSION['admininfo'];
        } else
            $session['ADMIN'] = false;

        if (isset($_SESSION['user'])) {
            define('USER', 1); //defined( 'USER' ) or die( 'Restricted access' );
            $session['USER'] = true;
            $session['user'] = $_SESSION['user'];
            $session['userinfo'] = $_SESSION['userinfo'];
        } else
            $session['USER'] = false;
        
        return $session;
    }

}
/*
die;
defined('PROTECT') or die('Restricted access');

//if (isset($_REQUEST[session_name()])) session_start();//таким образом, Мы стартуем сессию только тем, кто прислал идентификатор
session_start();

if (isset($_SESSION['admin'])) {
    define('ADMIN', 1); //defined( 'ADMIN' ) or die( 'Restricted access' );
    $GLOBALS['admin'] = $_SESSION['admin'];
    $GLOBALS['admininfo'] = $_SESSION['admininfo'];
} else
    $GLOBALS['admin'] = false;

if (isset($_SESSION['user'])) {
    define('USER', 1); //defined( 'USER' ) or die( 'Restricted access' );
    $GLOBALS['user'] = $_SESSION['user'];
    $GLOBALS['userinfo'] = $_SESSION['userinfo'];
} else
    $GLOBALS['user'] = false;
*/