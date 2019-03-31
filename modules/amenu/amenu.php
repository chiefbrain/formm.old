<?php
defined("PROTECT") or die("Restricted access");

//if(!defined('ALOGIN')) die( "Restricted access" );
if (!$app['admin'])
{
    die("Restricted access");
}

//$lang = file (dirname(__FILE__).'/amenu_'.$app['languages'] .'.lng');
$lang = $this->lng(dirname(__FILE__));

//if ($app['languages'] == 'ru') $lng=''; else $lng='/'.$app['languages'];
$lng = $app['prefixlang'];
$adm = $app['codeword'];
$url = $app['url'];

/* перечисл¤ем ссылки меню по пор¤дку  в массиве */
$links = array('/' . $adm . '/', '/' . $adm . '/addons/', '/' . $adm . '/slider2/', '/' . $adm . '/meta/', '/' . $adm . '/configurator/review.php?$url=/includes/modules.csv', '/' . $adm . '/projects/', '/' . $adm . '/admins/', '/' . $adm . '/ycap/', '/' . $adm . '/blog/', '/', 'exit');
/* перечисл¤ем style в массиве */
$dst = "border-right:1px solid #fff;"; //ƒополнительный стиль
//$style=array("width:74px;text-align:left;".$dst,"width:124px;".$dst,"width:139px;".$dst,"width:89px;".$dst,"width:94px;".$dst,"width:92px;text-align:right;");
$style = array('', '', '', '', '', '', '', '', '', '', '');
$js = array('', '', '', '', '', '', '', '', '', 'onclick="return !window.open(this.href)"', '');
/* —тиль выделеного пункта меню */
$StyleSelectPoint = 'color:#000;';
$z = 0;
echo '<ul>';
foreach ($links as $link) {
    if ($link != '/') {
        if ($link != '/admin/') {
            if (stripos($url, $lng . $link) === 0) {
                $DopStyle = $StyleSelectPoint;
            } else {
                $DopStyle = '';
            }
        } else if ($url == $lng . '/admin/') {
            $DopStyle = $StyleSelectPoint;
        } else {
            $DopStyle = '';
        }
    } else if ($url == $lng . '/') {
        $DopStyle = $StyleSelectPoint;
    } else {
        $DopStyle = '';
    }

    echo '<li><a style="' . $style[$z] . $DopStyle . '" href="' . $lng . $link . '" ' . $js[$z] . '>' . trim($lang[$z++]) . '</a></li>';
}
echo '</ul>';

//echo '>>>>>>>>>>'.$url;
?>
<!--
< ul>
    <li><a href="/admin/"><?= $lang[1]; ?></a></li>
    <li><a href="/admin/configurator/review.php?$url=/includes/modules.csv"><?= $lang[2]; ?></a></li>
    <li><a href="/" onclick="return !window.open(this.href)"><?= $lang[3]; ?></a></li>
    <li><a href="/admin/alogin/exit.php"><?= $lang[4]; ?></a></li>
    </ul>-->

