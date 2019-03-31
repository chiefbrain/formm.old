<?
defined('USERS') or die('Restricted access');

$tb = $app['TAB_COMM'];
$_col0 = '100px'; // Ширина последней колонки

if (isset($_GET['view']) && $_GET['view'] == '1')
{
    $idb = $_GET['idb'];
    $tb = $app['TAB_BLOG'];
//	$res=mysql_query("SELECT * FROM $tb WHERE id='$idb' LIMIT 1");
    $res = $app['db']->get($tb, '*', ['id' => $idb]);
    //if(mysql_num_rows($res))
    if (!empty($res))
    {
        $row = $res; //mysql_fetch_array($res);

        $id = $row['id'];
        $app['title'] = $row['title'];
        //$app['descript'] = '';
        $app['keywords'] = $row['tags'];

        if (file_exists($app['root'] . '/img/blog/' . $id . '_200.jpg'))
        {
            $img = '<img src="/img/blog/' . $id . '_200.jpg" style="margin:0 10px 10px 0;float:left;" alt=""/>';
            //$img = '<div style="margin:0 10px 10px 0;width:210px;height:210px;background:url(/img/blog/'.$id.'_200.jpg) center center no-repeat;outline:1px solid #ccc;float:left;"></div>';
        }
        else
        {
            $img = '';
        }
        echo $img . '<h1 style="text-align:center;">' . $row['title'] . '</h1>' . $row['text'];

        // комментарии:
        $bid = $row['id'];
        $tb = $app['TAB_COMM'];

//			$res=mysql_query("SELECT * FROM $tb WHERE id_blog='$bid' AND aktive='1' ORDER BY id");
        $res = $app['db']->select($tb, '*', ['AND' => ['id_blog' => $bid, 'aktive' => 1]]);
        //if (mysql_num_rows($res))
        if (!empty($res))
        {
            $comm = '<h1 style="margin:10px 0;">Комментарии:</h1>';
//            while ($row = mysql_fetch_array($res))
            foreach ($res as $row)
            {
                $comm .= '<div class="bx" style="margin: 10px 0;padding:10px;"><h2 style="margin-bottom:5px;">' . $row['name'] . '</h2>' . nl2br($row['comment']) . '</div>';
            }
        }
        echo $comm;

//        $_url = dirname(__FILE__) . '/comment_form.php';
//        if (file_exists($_url))
//        {
//            include $_url;
//        }
    }
    else
    {
        echo $this->p404();
    }
}
else if (isset($_GET['approved']) && $_GET['approved'] == '1')
{

    $aktive = $_GET['aktive'];
    $approved = $_GET['approved'];
    $id = $_GET['id'];

//    if (mysql_query("UPDATE $tb SET aktive='$aktive',approved='$approved' WHERE id=$id"))
    $app['db']->update($tb, ['aktive' => $aktive, 'approved' => $approved], ['id' => $id]);
    $app['debug']->db();
//    {
    $this->report('Edited !', $app['REFERER'], 'green', 0.5);
//    }
//    else
//    {
//        $this->report('Error !', REFERER, 'red');
//    }
}
else
{
//    $this_page = $app['detail_url'][1]; // Номер текущей страницы
//Пагинация

    //Узнать количество записей в таблице
//    $res = mysql_query("SELECT count(*) AS count FROM $tb WHERE approved=0");
//    $row = mysql_fetch_assoc($res);
//    $rows_max = $row['count'];//количество записей в таблице

    $rows_max = $app['db']->count($tb, ['approved' => 0]);

    //echo '$rows_max='.$rows_max;

    $show_pages = 10; // Сколько записей покажем пользователю

    $total_page = ceil($rows_max / $show_pages);//Всего страниц (Округляем в большую сторону)

    if (isset($app['detail_url'][1]) && is_numeric($app['detail_url'][1]))
    {
        $this_page = $app['detail_url'][1];
    }
    else
    {
        $this_page = 1;
    }
//    if ($app['detail_url'][1] == '') $this_page = 1; // Устанавливаем ПЕРВУЮ страницу, если не передан параметр

    if ($rows_max > 0 && ($this_page > $total_page || $this_page < 1)) echo p404();// проверка
    else
    {
        if ($total_page > 1)
        {
            for ($x = 0; $x++ < $total_page;)
            {// Выводит (12345678910) ссылки пагинации

                if ($x == $this_page) $border = 'border:1px solid #ccc;';
                else $border = '';

                if ($x == 1) $z = '';
                else $z = '-' . $x;

                $pag .= '<a style="padding:5px;margin:5px;' . $border . '" href="/' . $app['codeword'] . '/' . $app['component'] . '/comment' . $z . '/">' . $x . '</a>';
            }
            $pag = '<div style="float:left;width:99%;font-size: 12pt;padding:5px;margin-bottom:5px;text-align:center;">' . $pag . '</div>';
        }
        else $pag = '';
        //$offset = (($total_page - $this_page) * $show_pages)-$rows_last_page; //вычисляем смещение и корректируем его
        $offset = (($this_page * $show_pages) - $show_pages); //вычисляем смещение

//$res=mysql_query("SELECT * FROM $tb ORDER BY id DESC");//WHERE ");
//        $res = mysql_query("SELECT * FROM $tb WHERE approved=0 ORDER BY id LIMIT $offset,$show_pages");//WHERE ");
        $res = $app['db']->select($tb, '*', ['approved' => 0, 'LIMIT' => [$offset, $show_pages]]);
        //if (mysql_num_rows($res))
        $td = '';
        if (!empty($res))
        {
            //while ($row = mysql_fetch_array($res))
            foreach ($res as $row)
            {
                $id = $row['id'];
                $idb = $row['id_blog'];

                $td .= '<tr>';
                $td .= '<td>' . $id . '</td>';
                //$td .= '<td >'.$row['name'].'</td>';
                //$td .= '<td>'.$row['email'].'</td>';
                $td .= '<td style="text-align:left;"><b style="color:#f90;">' . $row['name'] . '</b><br/>' . $row['comment'] . '</td>';

                $td .= '<td><a href="?approved=1&amp;aktive=1&amp;id=' . $id . '">' . $_plus . '</a>
<a href="?approved=1&amp;aktive=0&amp;id=' . $id . '">' . $_minus . '</a>
<a href="?view=1&amp;idb=' . $idb . '" onclick="return !window.open(this.href)">' . $_link . '</a>
</td>';
                $td .= '</tr>';
            }
        }
        $first = true;
        $th = '<tr>';
        $th .= '<th style="width:' . $_col1 . ';">ID</th>';
//$th .= '<th>name</th>';
//$th .= '<th>link</th>';
        $th .= '<th>name &amp; comment</th>';
        $th .= '<th style="width:' . $_col0 . ';">Edit</th></tr>';

        echo $topmenu2 . $pag . '<table class="tab_block">' . $th . $td . '</table>';
    }
}
