<?php
defined('PROTECT') or die(include 'access.html');

/** use comb */
$comb = '';
if ($app['comb']) {
    $comb = '.comb';
}
?>

<div id="rfright" style="width:68%;float:right;padding:1%;overflow:hidden;">
    <? require 'components/forms/fform.php'; ?>
</div>

<div id="rfleft"  style="width:27%;float:left; padding:1%;overflow:hidden;"><? require 'components/forms/fmenu.php'; ?></div>

<!--  Всплывающее окно-->
<div id="mfon"></div>
<div id="win" style="top:2%;left:5%;width:90%;position:fixed;background:#fff;display:none;border:2px solid #f00;">

    <div style="height:20px;background:#800;color:#ff6;border-bottom:2px solid #f00;text-align:right;">

        <?php
        /* <p style="float:left;padding:2px;"> Будем Вам благодарны, если кликните по рекламе от g-o-o-l-e, в самом низу страницы.</p> */
        ?>
        <input type="button" value="X" style="width:20px;height:20px; font:15px sans-serif;cursor:pointer; " onclick="none()" />
    </div>

    <div id="win2" style="padding:1%;"></div>
    <div style="margin:1%; text-align:center;">
        <input class="button" type="button" value="Закрыть" style="width:150px;height:25px; font:15px sans-serif;cursor:pointer; " onclick="none()" />
    </div>
</div>

<script type="text/javascript" src="/components/forms/js/forms.pack.js<?= $comb ?>"></script>
<script type="text/javascript" src="/components/forms/js/cp.pack.js<?= $comb ?>"></script>
