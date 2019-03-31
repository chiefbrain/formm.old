<?php
defined( 'PROTECT' ) or die( 'Restricted access' );

/*
foreach ($GLOBALS['detail_url'] as $purl)
{
	$_url .= '/'.$purl;
}
$_url = ROOT .'/data'.$_url;*/
//if (file_exists($_url)) include($_url); else include(ROOT .'/data/404.html');
if ($app['url']!='')
{
	$_url = $app['root'] .'/data'.$app['url'];
	if (file_exists($_url)) echo file_get_contents($_url); else echo $this->p404();
}
else echo $this->p404();