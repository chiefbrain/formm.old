<?php

defined( "PROTECT" ) or die( "Restricted access" );

$app['title'] = 'РЕГИСТРАЦИЯ';
$app['keywords'] = 'регистрация,';

if(count($_POST)>0) include $app['root'] .'/components/regs/reg.php';
else include $app['root'] .'/components/regs/regform.php'; /*  */
