<?php

defined('PROTECT') or die('Restricted access');



if ($app['url'] != '')
    require $app['root'] . '/components/forms' . $app['url'];
else
    require $app['root'] . '/components/forms/rform.php';
