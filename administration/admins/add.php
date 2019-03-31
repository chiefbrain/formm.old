<?
defined( 'USERS' ) or die( 'Restricted access' );

if ($_POST['action'] == 'add')
{
	$login = mysql_real_escape_string($_POST['login']);
	$res=mysql_query("SELECT * FROM $tb WHERE login='$login' LIMIT 1");
	if(!mysql_num_rows($res))
	{
	
	
	foreach ($app[$info] as $aik=>$aiv)
	{
		if (isset($_POST[$aik]))
		{
			$kdb .= $aik.",";
			$vdb .= "'".mysql_real_escape_string($_POST[$aik])."',";
		}
	}
	if ($_POST['password']!='' && $_POST['login']!='')
	{
		include ROOT .'/includes/salt.php';
		$salt = generateSalt();
		
		$kdb .= "password,";
		$vdb .= "'".md5(md5(mysql_real_escape_string($_POST['password'])).$salt)."',";
		
		$kdb .= "salt";
		$vdb .= "'".$salt."'";
		
		if (mysql_query("INSERT INTO $tb ($kdb) VALUES ($vdb)")) report ('Edited !',REFERER, 'green'); else report ('Error !',REFERER, 'red');
	}
	else report ('Error ! Enter your login and password !',REFERER, 'red');
	
	}
	else report ('Login Register !',REFERER, 'red');
}
else
{
	$action='add';
	include dirname(__FILE__).'/form.php';
}
?>