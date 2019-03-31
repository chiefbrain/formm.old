<?php

defined('USERS') or die('Restricted access');

//Пагинация
//Узнать количество записей в таблице
//$res = mysql_query("SELECT count(*) AS count FROM $tb");
//$row = mysql_fetch_assoc($res);
//$rows_max = $row['count']; //количество записей в таблице
//echo '$rows_max='.$rows_max;

$rows_max = $app['db']->count($tb); //количество записей в таблице

$show_pages = 10; // Сколько записей покажем пользователю

$total_page = ceil($rows_max / $show_pages); //Всего страниц (Округляем в большую сторону)

if ($app['url'] == '')
{
    $this_page = 1; // Устанавливаем ПЕРВУЮ страницу, если не передан параметр
}

if ($rows_max > 0 && ($this_page > $total_page || $this_page < 1))
{
    echo $this->p404(); // проверка
}
else
{
    if ($total_page > 1)
    {
        $pag = '';
        for ($x = 0; $x++ < $total_page;)
        {// Выводит (12345678910) ссылки пагинации
            if ($x == $this_page)
            {
                $border = 'border:1px solid #ccc;';
            }
            else
            {
                $border = '';
            }

            if ($x == 1)
            {
                $z = '';
            }
            else
            {
                $z = '-' . $x;
            }

            $pag .= '<a style="padding:5px;margin:5px;' . $border . '" href="/' . $app['codeword'] . '/' . $app['component'] . $z . '/">' . $x . '</a>';
        }
        $pag = '<div style="float:left;width:99%;font-size: 12pt;padding:5px;margin-bottom:5px;text-align:center;">' . $pag . '</div>';
    }
    else
    {
        $pag = '';
    }

    //$offset = (($total_page - $this_page) * $show_pages)-$rows_last_page; //вычисляем смещение и корректируем его
    $offset = (($this_page * $show_pages) - $show_pages); //вычисляем смещение
    //$res=mysql_query("SELECT * FROM $tb ORDER BY id DESC");//WHERE ");
    //$res = mysql_query("SELECT * FROM $tb ORDER BY id DESC LIMIT $offset,$show_pages"); //WHERE ");
    $res = $app['db']->select($tb, '*', ['ORDER' => ['id' => 'DESC'], 'LIMIT' => [$offset, $show_pages]]);
    //if (mysql_num_rows($res))
    if (!empty($res))
    {
        //while ($row = mysql_fetch_array($res))
        $td = '';
        foreach ($res as $row)
        {
            $id = $row['id'];

            $td .= '<tr>';
            $td .= '<td>' . $id . '</td>';
            $td .= '<td><a href="/blog-' . $row['link'] . '.html" onclick="return !window.open(this.href)">' . $row['title'] . '</a></td>';
            $td .= '<td>' . $row['link'] . '.html</td>';
            $td .= '<td>' . $row['anons'] . '</td>';

            $td .= '<td><a href="/' . $app['codeword'] . '/' . $app['component'] . '/edit-' . $id . '">' . $_edit . '</a><a href="/' . $app['codeword'] . '/' . $app['component'] . '/del-' . $id . '">' . $_del . '</a></td>';
            $td .= '</tr>';
        }
    }
    $first = true;
    $th = '<tr>';
    $th .= '<th style="width:' . $_col1 . ';">ID</th>';
    $th .= '<th>title</th>';
    $th .= '<th>link</th>';
    $th .= '<th>anons</th>';
    $th .= '<th style="width:' . $_col0 . ';">Edit</th></tr>';

    /* ######################### */
    $tb = $app['TAB_COMM'];
    //Узнать количество записей в таблице
    //$res = mysql_query("SELECT count(*) AS count FROM $tb WHERE approved=0");
    //$row = mysql_fetch_assoc($res);
    //$rows_max = $row['count']; //количество записей в таблице

    $rows_max = $app['db']->count($tb, ['approved' => 0]); //количество записей в таблице

    $dopmenu = '';
    if ($rows_max > 0)
    {
        $dopmenu = '<a href="/' . $app['codeword'] . '/' . $app['component'] . '/comment">' . $_comm . ' Не просмотренные комментарии (' . $rows_max . ')</a>';
    }
    /* ######################### */

    $topmenu = '<a href="/' . $app['codeword'] . '/' . $app['component'] . '/add">' . $_add . ' Добавить</a> ' . $dopmenu;
    echo $topmenu . '<br/><br/>' . $pag . '<table class="tab_block">' . $th . $td . '</table>';
}