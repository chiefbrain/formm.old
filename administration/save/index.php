<?php

defined('ADMIN') or die('Restricted access');

$lang = $this->lng(dirname(__FILE__));

if (isset($_POST['action']) && $_POST['action'] == 'action')
{
    $url = $_POST['url'];

    file_put_contents($url, stripslashes($_POST['content']));

    $this->report($lang[0], $app['REFERER'], 'green');
}