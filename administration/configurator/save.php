<?
defined( 'PROTECT' ) or die( 'Restricted access' );
//if(LEVEL<7) die(header ("Location: http://".$_SERVER['HTTP_HOST']));
if(!defined('ALOGIN')) die( "Restricted access" );

//$lang = file (dirname(__FILE__).'/admin.lng');
$lang = file (dirname(__FILE__).'/config_'.LNG .'.lng');

if($_POST['action']=='action') {
$url=$_POST['url'];

file_put_contents($url, stripslashes($_POST['content']));

report($lang[0],REFERER,'green');
}
?>