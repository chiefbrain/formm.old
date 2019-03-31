<?
defined( 'USERS' ) or die( 'Restricted access' );

$id = $app['detail_url'][1];

if ($_POST['action'] == 'del')
{
	if (mysql_query("DELETE FROM $tb WHERE id='$id'")) report ('Removed !','/'.$app['codeword'].'/'.$dir.'/', 'red');
}
else
{
	$action='del';
	
	$res=mysql_query("SELECT * FROM $tb WHERE id='$id' LIMIT 1");
	if(mysql_num_rows($res))
	{
		$row=mysql_fetch_array($res);
	}
	echo $topmenu2;
	?>
<div style="width:100%;float:left;padding:10px;">
<p style="text-align:center;padding:10px;color:red;"><?= $action; ?> ???!</p>
<div style="margin-left:50%;position:relative; left:-200px; width:400px;">
<form action="" method="post">
<input name="action" type="hidden" value="<?= $action; ?>" />
<table class="tab_block">
<?
foreach ($app[$info] as $aik=>$aiv)
{
		if (isset($row[$aik])) $val=$row[$aik];
		?>
		<tr>
		<td style="width:100px;"><?= $aik; ?></td>
		<td><?= $val; ?></td>
		</tr>
		<?
}
?>
</table>
<div style="text-align:center;">
<input type="submit"  value=" OK " style="width:200px;margin:3px 0 5px 0;" />
</div>

</form>
</div>
</div>
	<?
}

?>