<?
defined( 'ADMIN' ) or die( 'Restricted access' );

//session_start();
//$lang = file (dirname(__FILE__).'/alogin_'.LNG .'.lng');
$lang = lng(dirname(__FILE__));

if (isset($_REQUEST['captcha']))
{
	include ROOT .'/captcha2/inc/check.php';
		
	if(isset($check_captcha) && $check_captcha)
		{
			
		} else $err=true;
		
	if ($err)
	{
		report('ERROR !' ,REFERER,red);//Ошибка авторизации!
	}
	else
	{
		report('OK !!!',REFERER,green,0.5);//Авторизация прошла успешно!
	}
}
else
{
	$tb = 'formm_cookies'; // Таблица в БД
	// Удаляем ненужные
	mysql_query("DELETE FROM $tb WHERE destroy='1'");
	$res = mysql_query("SELECT COUNT(*) FROM $tb");
	$row = mysql_fetch_row($res);
	$total = $row[0]; // всего записей
	//echo $total;
	
?>
<div style="width:100%;float:left;padding:10px;">
<p style="text-align:center;padding:20px;font-size:20px;color:green;">Total number of records: <?= $total; ?></p>
<div style="margin-left:50%;position:relative; left:-106px; width:212px;">
<form name="fcap" action="" method="post">

<div style="width:100%;margin-top:10px;">
<img style="float:left;" border="0" src="/captcha2/" alt="formm.captcha" onclick="formm.cap();"/>
<img border="0" style="cursor:pointer;margin:14px 0;float:left;" src="http://formm.ru/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>

<input name="captcha" type="text" style="margin-top:10px;width:100%;height:20px;" maxlength="6" />

</div>

<div style="margin-top:10px; text-align:center;"><input type="submit" style="width:155px;height:30px;cursor:pointer;" /></div>

</form>

</div>
</div>

<script type="text/javascript" src="http://formm3.localhost/mail/js/captcha2.js"></script>
<script type="text/javascript">

//document.write('<'+'script type="text/JavaScript" src="http://formm3.localhost/js/formm.php?char=',document.charset || document.characterSet, '"><\/'+'script>');
window.onload = function () {fcap.captcha.focus();}

</script>

<?
}

//echo date("d.m.Y - H:i:s",gmmktime()).'<br/>'.gmdate("d.m.Y - H:i:s", gmmktime()+14400).'<br/>';
/*
foreach (DateTimeZone::listIdentifiers() as $dtz)
{
	echo $dtz.'<br/>';
}*/

?>