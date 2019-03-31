<?
define( 'PROTECT', 1 );
error_reporting (E_ALL);
session_start();
/* Using:

	<?php
	session_start();
	?>
	<form action="./" method="post">
	<p>Enter text shown below:</p>
	<p><img src="PATH-TO-THIS-SCRIPT?<?php echo session_name()?>=<?php echo session_id()?>"></p>
	<p><input type="text" name="keystring"></p>
	<p><input type="submit" value="Check"></p>
	</form>
	<?php
	if(count($_POST)>0){
		if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
			echo "Correct";
		}else{
			echo "Wrong";
		}
	}
	unset($_SESSION['captcha_keystring']);
	?>

*/

include('kcaptcha.php');

//if(isset($_REQUEST[session_name()])) 
//session_start();

$captcha = new KCAPTCHA();

//if($_REQUEST[session_name()]){
	//$_SESSION['captcha_keystring'] = $captcha->getKeyString();
//}

//define( 'PROTECT', 1 ); //defined( 'PROTECT' ) or die( 'Restricted access' );
/*define( 'REFERER', str_replace('http://','',str_replace('http://www.','',$_SERVER['HTTP_REFERER'])));
if (substr(REFERER, -1)=='/') $ref=addslashes(substr(REFERER, 0, -1)); else $ref=addslashes(REFERER);
include '../includes/connect.php';
$res=mysql_query("SELECT * FROM $db_fum WHERE link='$ref' LIMIT 1");
if(mysql_num_rows($res)) {
$row=mysql_fetch_array($res);
$id=$row['id'];
$cap=$captcha->getKeyString();
mysql_query("UPDATE $db_fum SET сaptcha='$cap' WHERE id=$id");


} else {*/
//session_start();
$_SESSION['captcha_keystring'] = $captcha->getKeyString();
//}
?>