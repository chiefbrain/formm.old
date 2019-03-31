<?php

defined("PROTECT") or die("Restricted access");

$lang = $this->lng(dirname(__FILE__));

//$lang = file (dirname(__FILE__).'/menu_'.$app['languages'] .'.lng');
//if ($app['languages'] == 'en') $lng='/en'; else $lng='';
if ($app['languages'] == 'ru')
    $lng = '';
else
    $lng = '/' . $app['languages'];

include dirname(__FILE__) . '/config.php';

/* перечисляем ссылки меню по порядку  в массиве */
//$links=array( '/','/about.html','/projects/','/service.html','/reviews.html','/contacts.html');
/* перечисляем style в массиве */
//$dst="border-right:1px solid #fff;";//Дополнительный стиль
//$style=array("width:74px;text-align:left;".$dst,"width:124px;".$dst,"width:139px;".$dst,"width:89px;".$dst,"width:94px;".$dst,"width:92px;text-align:right;");
//$style = array();
/* Стиль выделеного пункта меню */
//$StyleSelectPoint='color:#000;';

$z = 0;

$url = str_replace($app['main'], '', $app['url']);

$mmm = '<ul>';
foreach ($links as $link)
{
    if ($link != '/')
    {

        if (stripos($url, $lng . $link) === 0)
            $sClass = $selectedClass;
        else
            $sClass = '';
    } else if ($url == $lng . '/')
        $sClass = $selectedClass;
    else
        $sClass = '';

    $ll = $lng . $link;
    if ($ll != '')
        $ll = ' href="' . $ll . '"';

    //echo'<li><a '.$sClass.' style="'.$style[$z].'"'.$ll.' '.$js[$z].'>'.trim($lang[$z++]).'</a></li>';
    $mmm .= '<li><a ' . $sClass . $ll . ' ' . $js[$z] . '>' . trim($lang[$z++]) . '</a></li>';
}
$mmm .= '</ul>';

echo $mmm;

/*
  //echo $_SERVER['HTTP_USER_AGENT'];
  $ua=$_SERVER['HTTP_USER_AGENT'];

  $pos1 = stripos($ua, 'opera');
  //$pos2 = stripos($ua, 'MSIE');

  if ($pos1 !== false) {
  $oi='style="padding-top:33px;"';
  } */


