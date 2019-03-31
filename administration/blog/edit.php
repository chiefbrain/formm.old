<?
defined('USERS') or die('Restricted access');

/*$id = $app['detail_url'][1];

if ($_POST['action'] == 'edit')
{
	$ed=false;
	$login = mysql_real_escape_string($_POST['login']);
	$res=mysql_query("SELECT * FROM $tb WHERE login='$login' LIMIT 1");
	if(mysql_num_rows($res))
	{
		$row=mysql_fetch_array($res);
		if ($id == $row['id']) $ed = true;
	} else $ed = true;
	
	if($ed)
	{
	
	foreach ($app[$info] as $aik=>$aiv)
	{
		if (isset($_POST[$aik])) $params .= $aik."='".mysql_real_escape_string($_POST[$aik])."',";
	}
	if ($_POST['password']!='')
	{
		include ROOT .'/includes/salt.php';
		$salt = generateSalt();
		$params .= "password='".md5(md5($_POST['password']).$salt)."',";
		$params .= "salt='".$salt."'";
		
	}
	else $params = substr($params,0,-1);
	
	if (mysql_query("UPDATE $tb SET $params WHERE id=$id")) report ('Edited !',REFERER, 'green'); else report ('Error !',REFERER, 'red');
	
	}
	else report ('Login Register !',REFERER, 'red');
}
else
{*/
$action = 'edit';

//	$res=mysql_query("SELECT * FROM $tb WHERE id='$id' LIMIT 1");
$res = $app['db']->get($tb, '*', ['id' => $id]);

//	if(mysql_num_rows($res))
if (!empty($res))
{
    $row = $res; //mysql_fetch_array($res);
}

include dirname(__FILE__) . '/form.php';
//}