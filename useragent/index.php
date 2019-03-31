<?
/*$a=false;
if (isset ($_GET['uac']))
{
	//$nf='/uac.txt';
	$ua = $_GET['uac'];
	$a=true;
}
else if (isset ($_GET['ua']))
{
	//$nf='/ua.txt';
	$ua = base64_decode($_GET['ua']);
	$a=true;
}*/

//'Yandex','Yahoo','Wget','WebAlta','W3C','Scooter','Pagebull','Ooyyo','OmniExplorer','omni-explorer','msn','mihalism','inktomi','Gulper',
$ua = $_SERVER['HTTP_USER_AGENT'];

if ($ua != '')
{
$nf='/useragent.txt';
$f = dirname(__FILE__).$nf;
if (file_exists($f)) $txt = file_get_contents ($f);
$pos = strpos($txt, $ua);
if ($pos === false)
{
	$txt = $txt.$ua."\n";
	file_put_contents ( $f, $txt);
}
}
?>