<?php
/** gZip On */
ini_set('zlib.output_compression', 1);
ini_set('zlib.output_compression_level', -1);

/** errors On */
ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(-1); // E_ALL - отображаем ВСЕ ошибки -1 все-все ошибки ))

/* formm.ru */
define('PROTECT', 1); //defined( 'PROTECT' ) or die( 'Restricted access' );
$time_start = microtime(1); // Засекаем время

require 'vendor/autoload.php';

/** Включаем на проде */
$SAPE_ON = false;
$COUNTER_ON = false;
$BANNER_ON = false;
$COMB_ON = false;

$conf = new \App\Index\Config(dirname(__FILE__));
$app = $conf->getApp();

$app['time_start'] = $time_start;
$app['counter_google'] = $COUNTER_ON;
$app['counter_mail'] = $COUNTER_ON;
$app['counter_yandex'] = $COUNTER_ON;

$app['banner_google'] = $BANNER_ON;

$app['comb'] = $COMB_ON;

$s = new \App\Index\Authorize($app);
$app = array_merge($app, $s->getSession());

if ($SAPE_ON) {
    $sape = new \App\Index\Sape();
    $app['sape'] = $sape->getSape();
    $app['sape_context'] = $sape->getSapeContext();
}

$url = new \App\Index\Url($app);
$app = array_merge($app, $url->get());
//print_r($app);die;
$app['debug'] = new \App\Add\Debug($app['db']);

$app['f'] = new \App\Index\MyFunction($app);

//ob_start("ob_gzhandler");

$content = new \App\Index\Content($app);

$j = $content->make();
//print_r($app);die;
$content->view($j);

//define('DB', $db); //$_SERVER['DOCUMENT_ROOT']);

//define('ROOT', dirname(__FILE__)); //$_SERVER['DOCUMENT_ROOT']);




//print_r($app);
die;

//require ROOT . '/includes/index/config.php';
//require ROOT . '/includes/index/function.php'; // Функции и Подключение к БД и Другие...
//require ROOT . '/includes/index/autorize.php';
//require ROOT . '/includes/index/url.php';
//require ROOT . '/includes/index/content.php';
//require ROOT . '/includes/index/print.php';
//require ROOT .'/includes/index/stat.php'; // Сбор статистики
