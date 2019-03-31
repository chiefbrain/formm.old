<?php

defined('PROTECT') or die('Restricted access');

$tb = $app['TAB_BLOG'];

$offset = 10; // с какой строки делать выборку из базы
$limit  = 100000; // сколько строк делать выборку из базы
$nastr  = 10; // сколько записей на странице
$pages  = 2; // начало нумервции страниц

$pagew = 998; // ширина страницы -2px

$padd = 6; // сумма правого и левого паддингов

$blw  = floor(($pagew - 50) / $nastr); // ширина одного блока с сылкой на статью
$_blw = $pagew - ($blw * $nastr) - $padd; // ширина первого блока с сылкой на страницу блога
$blw  = $blw - $padd;
$z    = $nastr;

//$res=mysql_query("SELECT title,link FROM $tb ORDER BY id DESC LIMIT $offset,$limit");

$res = $app['db']->select($tb, ['title', 'link'], ['ORDER' => ['id' => 'DESC'], 'LIMIT' => [$offset, $limit]]);
$list = '';
//if (mysql_num_rows($res))
if (!empty($res))
{
    //$list = '<div style="float:left;width:100%;"></div>';
    $list = '<br/>'; // ХЗ зачем этот BR но без него глюки в FF !!!
    //while ($row  = mysql_fetch_array($res))
    foreach ($res as $row)
    {
        /* $id = $row['id'];

          if (file_exists(ROOT .'/img/blog/'.$id.'_50.jpg')) //$img = '<img src="/img/blog/'.$id.'_100.jpg" style="margin:5px;float:left;" alt=""/>';
          $img = '<div class="img50" style="background:url(/img/blog/'.$id.'_50.jpg) center center no-repeat;"></div>';
          else $img=''; */
        if ($z == $nastr)
            $list .= '<div class="anons2" style="width:' . $_blw . 'px;background:#dcdcdc;"><a href="/blog-' . $pages . '/">Блог с.' . $pages++ . ':</a></div>';
        $list .= '<div class="anons2" style="width:' . $blw . 'px;" title="' . $row['title'] . '"><a href="/blog-' . $row['link'] . '.html">' . $row['title'] . '</a></div>';
        /* $list .= $img;
          $list .= '<div  style="margin-left:70px;text-align:center;">';
          $list .= '<a href="/blog-'.$row['link'].'.html">'.$row['title'].'</a></div></div>';//<br/>'; */
        //$list .= $row['anons'].'</div></div>';
        $z--;
        if ($z == 0)
            $z    = $nastr;
    }
    //$list. = '</div>';
}
echo $list;


