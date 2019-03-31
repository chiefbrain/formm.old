<?
defined( 'PROTECT' ) or die( 'Restricted access' );
/*if(LEVEL<7) die(header ("Location: http://".$_SERVER['HTTP_HOST']));*/
if(!defined('ALOGIN')) die( "Restricted access" );
?>
<ul style="padding:10px;list-style:none;">
<li style="display:inline;margin:0 5px;"><a href="/admin/configurator/review.php?url=/includes/modules.csv" style="color:#800;">Modules</a></li>
<?
$arrf = file(ROOT .'/includes/modules.csv');
foreach ($arrf as $arf) {
$arf=trim($arf);
$af = explode(";", $arf);
?>
<li style="display:inline;margin:0 5px;"><a href="/admin/configurator/review.php?url=<?= $af[1]; ?>" style="color:#800;"><?= $af[2]; ?></a></li>
<?
}

?>
</ul>