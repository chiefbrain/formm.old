<?php

defined('PROTECT') or die('Restricted access');

$lang = $this->lng(dirname(__FILE__));

$adm = '';
$and = '';
$usr = '';


if ($app['ADMIN'])
{
    $adm = $app['admin'];
}

if ($app['USER'])
{
    $usr = $app['user'];
}

if ($app['ADMIN'] && $app['USER'])
{
    $and = ' &amp; ';
}

session_destroy();
$this->report($lang[7] . ' , ' . $adm . $and . $usr, '/', 'green');
