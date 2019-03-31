<?php
defined('PROTECT') or die('Restricted access');
/**/
$mySape = '';
if (isset($app['sape'])) {
    $sape = $app['sape'];
    $mySape = str_replace(". .  ", ".<br/>", $sape->return_links(2));
}
?>
<div style="text-align:center;padding:20px;">

    <?= $mySape; ?>

</div>
