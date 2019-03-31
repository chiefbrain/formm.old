<?php
defined('PROTECT') or die('Restricted access');

//$lang = lng(dirname(__FILE__));

//print_r($app);die;

$bas = basename(dirname(__FILE__));
$fil = dirname(__FILE__) . '/' . $bas . '_' . $app['languages'] . '.lng';
if (file_exists($fil)) {
    $meta = explode('~', file_get_contents($fil));
}
if ($app['title'] != '') {
    $app['title'] .= ' - ';
}
if ($app['descript'] != '') {
    $app['descript'] .= ' ';
}
if ($app['keywords'] != '') {
    $app['keywords'] .= ' ';
}

/** use comb */
$comb = '';
if ($app['comb']) {
    $comb = '.comb';
}
?>

    <title><?php echo $app['title'] . trim($meta[0]) ?></title>

    <meta name="Description"
          content="<?= $app['descript'] . trim($meta[1]) ?>"/>
    <meta name="Keywords" content="<?= $app['keywords'] . trim($meta[2]) ?>"/>

    <meta name="abstract"
          content="Вебсервис создан в помощь вебмастеров - форма, конструктор форм,генератор формы,создать форму,мастер форм,обратной связи"/>
    <meta name="subject" content="Вебсервис создания форм обратной связи"/>
    <meta name="site-created" content="10-10-2010"/>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta http-equiv="Content-Language" content="<?= $app['languages']; ?>"/>
    <meta name="robots" content="index, follow"/>

    <link rel="icon" type="image/x-icon" href="/img/favicon.ico"/>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="/general/css/style.css<?= $comb ?>"/>
    <link rel="stylesheet" type="text/css" href="/templates/<?= $app['template'] ?>/css/style.css<?= $comb ?>"/>

    <script type="text/javascript" src="/js/sv.pack.js<?= $comb ?>"></script>


<?php
//<meta name="telderi" content="68d0f8ae64db87937890f1ba8060b085" />
//<!--<script type="text/javascript" src="/js/general.js"></script>-->

/* $url = substr( URL .'/' , 1);
  $pos = strpos($url, '/');
  if ($pos !== false) {
  $url = '/css/'.substr($url, 0, $pos).'.css'; */
$url = '/css/' . $app['component'] . '.css';

//echo '<br/><br/><br/><br/>!!!!!!!!!!!!!!!! '.$url;
if (file_exists($app['root'] . $url)) {
    echo '<link rel="stylesheet" type="text/css" href="' . $url . $comb. '" />'
        . "\n";
}
//}
$url = '/js/' . $app['component'] . '.js';

//echo '<br/><br/><br/><br/>!!!!!!!!!!!!!!!! '.$url;
if (file_exists($app['root'] . $url)) {
    echo '<script type="text/javascript" src="' . $url . $comb . '"></script>'
        . "\n";
}
?>
