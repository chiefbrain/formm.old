<?php

defined('PROTECT') or die('Restricted access');
include substr($url, 0, -3) . 'html';
$text = file_get_contents(substr($url, 0, -3) . 'html');
/** Модификация для SAPE - START */

if (isset($app['sape_context'])) {
    $sape_context = $app['sape_context'];
    $text = $sape_context->replace_in_text_segment($text);
}

/** Модификация для SAPE - END */

//$text = file_get_contents(substr($url, 0, -3).'html');
echo $text;
