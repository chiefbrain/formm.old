<?php

defined('ADMIN') or die('Restricted access');

define('USERS', 1); //defined( 'USERS' ) or die( 'Restricted access' );

$tb = $app['TAB_ADMIN'];
$info = 'admininfo';
$dir = 'admins';

//$lang = $this->lng(dirname(__FILE__));

$_add = '<img src="/img/unitab/001_01.gif" class="img_block" alt="add"/>';
$_back = '<img src="/img/unitab/001_23.gif" class="img_block" alt="back" />';
$_submit = '<img src="/img/unitab/001_06.gif" class="img_block" style="cursor:pointer;" alt="submit" onclick="forma.submit();" />';
$_edit = '<img src="/img/unitab/001_45.gif" class="img_block" alt="edit" title="edit"/>';
$_del = '<img src="/img/unitab/001_05.gif" class="img_block" alt="del" title="del"/>';

$topmenu2 = '<a href="/' . $app['codeword'] . '/' . $dir . '/">' . $_back . ' BACK</a><br/><br/>';

$_col1 = '30px'; // Ўирина первой колонки
$_col0 = '50px'; // Ўирина последней колонки

$_url = dirname(__FILE__);

//if ($app['url']=='') $_url .= '/list.php'; else $_url .= $app['url'].'.php';
if (isset($app['detail_url'][0]) && $app['detail_url'][0] != '')
{
    $_url .= '/' . $app['detail_url'][0] . '.php';
}
else
{
    $_url .= '/list.php';
}

if (file_exists($_url))
{
    include $_url;
}
else
{
    echo $this->p404();
}
