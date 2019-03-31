<?
defined( 'PROTECT' ) or die( 'Restricted access' );
//if(LEVEL<7) die(header ("Location: http://".$_SERVER['HTTP_HOST']));
if(!defined('ALOGIN')) die( "Restricted access" );

$url=$_GET['url'];
include dirname(__FILE__).'/configurator.php';
echo $url.'<br/>';
?>


<form action="/admin/configurator/save.php" method="post">


<textarea name="content" cols="100" rows="50" style="width:100%;height:500px;"><?= htmlspecialchars(file_get_contents(ROOT .$url)); ?></textarea>
<input type="hidden" name="url" value="<?= ROOT .$url; ?>"/>
<input type="hidden" name="action" value="action"/>
<input type="submit" value="Save"/>
</form>