<?
defined( 'USERS' ) or die( 'Restricted access' );
echo $topmenu2;
?>

<div style="width:100%;float:left;padding:10px;">
<p style="text-align:center;padding:10px;"><?= $action; ?></p>
<div style="margin-left:50%;position:relative; left:-200px; width:400px;">
<form action="" method="post">
<input name="action" type="hidden" value="<?= $action; ?>" />
<?
foreach ($app[$info] as $aik=>$aiv)
{
	if ($aik!='id')
	{
		if (isset($row[$aik])) $val=$row[$aik];
		?>
		<p><?= $aik; ?></p>
		<input name="<?= $aik; ?>" type="text" value="<?= $val; ?>" maxlength="50" style="width:400px;height:20px;margin:3px 0 5px 0;" />
		<?
	}
	if ($aik=='login')
	{
		?>
		<p>password</p>
		<input name="password" type="password" maxlength="50" style="width:400px;height:20px;margin:3px 0 5px 0;" />
		<?
	}
}
?>
<div style="text-align:center;">
<input type="submit"  value=" OK " style="width:200px;margin:3px 0 5px 0;" />
</div>

</form>
</div>
</div>