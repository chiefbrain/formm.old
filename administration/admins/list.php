<?php

defined('USERS') or die('Restricted access');

//$res=mysql_query("SELECT * FROM $tb ORDER BY id");//WHERE ");
$res = $app['db']->select($tb, '*', ['ORDER' => 'id']);

$td = '';

if (!empty($res))
{
    //while ($row = mysql_fetch_array($res))
    foreach ($res as $row)
    {
        $td .= '<tr>';
        foreach ($app[$info] as $aik => $aiv)
        {
            $td .= '<td>' . $row[$aik] . '</td>';
        }
        $id = $row['id'];
        $td .= '<td><a href="edit-' . $id . '">' . $_edit . '</a><a href="del-' . $id . '">' . $_del . '</a></td>';
        $td .= '</tr>';
    }
}

$first = true;
$th = '<tr>';
foreach ($app[$info] as $aik => $aiv)
{
    if ($first)
    {
        $first = false;
        $fstyle = ' style="width:' . $_col1 . ';"';
    }
    else
    {
        $fstyle = '';
    }
    $th .= '<th' . $fstyle . '>' . $aik . '</th>';
}
$th .= '<th style="width:' . $_col0 . ';">Edit</th></tr>';
$topmenu = '<a href="add">' . $_add . ' Добавить</a>';
echo $topmenu . '<br/><br/><table class="tab_block">' . $th . $td . '</table>';
