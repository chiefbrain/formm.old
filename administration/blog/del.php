<?
defined('USERS') or die('Restricted access');

/*$id = $app['detail_url'][1];

if ($_POST['action'] == 'del')
{
	if (mysql_query("DELETE FROM $tb WHERE id='$id'")) report ('Removed !','/'.$app['codeword'].'/'.$dir.'/', 'red');
}
else
{*/
$action = 'del';

//$res = mysql_query("SELECT * FROM $tb WHERE id='$id' LIMIT 1");
$res = $app['db']->get($tb, '*', ['id' => $id]);
//if (mysql_num_rows($res))
if (!empty($res))
{
    $row = $res; //mysql_fetch_array($res);

    echo $topmenu2;
    ?>
    <div style="width:100%;float:left;padding:10px;">
        <p style="text-align:center;padding:10px;color:red;">Remove ???!</p>
        <div style="margin-left:50%;position:relative; left:-300px; width:600px;">
            <form action="" method="post">
                <input name="action" type="hidden" value="<?= $action; ?>"/>
                <table class="tab_block">
                    <tr>
                        <td style="width:100px;">id</td>
                        <td><?= $id; ?></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">title</td>
                        <td><?= $row['title']; ?></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">link</td>
                        <td><?= $row['link']; ?></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">tags</td>
                        <td><?= $row['tags']; ?></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">anons</td>
                        <td><?= $row['anons']; ?></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">text</td>
                        <td><?= $row['text']; ?></td>
                    </tr>
                </table>
                <div style="text-align:center;">
                    <input type="submit" value=" Remove " style="width:200px;margin:3px 0 5px 0;"/>
                </div>

            </form>
        </div>
    </div>
    <?
}
else
{
    echo 'ERROR !';
}
?>