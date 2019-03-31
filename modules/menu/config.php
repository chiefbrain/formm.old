<?php

defined("PROTECT") or die("Restricted access");

/* перечисляем ссылки меню по порядку  в массиве */
$links         = array('/', '/forms/', '/punycode/', '/regs/', '/forms/mailto.php', '/blog/', '/donate.html'); //,'');
/* перечисляем style в массиве */
//$dst="border-right:1px solid #fff;";//Дополнительный стиль
//$style=array("width:75px;text-align:left;".$dst,"width:115px;".$dst,"width:90px;".$dst,"width:130px;".$dst,"width:70px;".$dst,"width:85px;".$dst,"width:85px;text-align:right;");
$js            = array('', '', '', '', '', '', ''); //,'onclick="return add_favorite(this);"');
/* Стиль выделеного пункта меню */
$selectedClass = 'class="selected"';
/*$StyleSelectPoint='color:#000;';*/


