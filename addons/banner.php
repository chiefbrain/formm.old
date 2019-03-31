<?php
defined('PROTECT') or die('Restricted access');

/** Google banner */
if ($app['banner_google']) {
    include substr($url, 0, -3) . 'html';
}
