<?php

defined('PROTECT') or die('Restricted access');

//echo 'list = '.$_GET['list'].'<br/>';
//echo '$app[url]='.$app['url'];


if (isset($_POST['action']) && $_POST['action'] == 'comment')
{
    if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha'])
    {

        function rt($t)
        {
            return $t; //strip_tags(mysql_real_escape_string($t)); //, '<b>');
        }

        $tb      = $app['TAB_COMM'];
        $id      = rt($_POST['id']);
        $name    = rt($_POST['name']);
        $email   = rt($_POST['email']);
        $comment = rt($_POST['comment']);
        //if (mysql_query("INSERT INTO $tb (id_blog,name,email,comment) VALUES ('$id','$name','$email','$comment')"))

        $app['db']->insert($tb, ['id_blog' => $id, 'name' => $name, 'email' => $email, 'comment' => $comment]);

        $this->report('comment has been saved !', $app['REFERER'], 'green');
    }
    else
        $this->report('CAPTCHA error !', $app['REFERER'], 'red');
    unset($_SESSION['captcha_keystring']);
}
else
{


    $tb = $app['TAB_BLOG'];

    if (isset($app['detail_url'][0]))
        $detail_url = $app['detail_url'][0];
    else
        $detail_url = '';

    $this_page = $detail_url; //mysql_real_escape_string($detail_url); // Номер текущей страницы

    if ($app['url'] == '' || ctype_digit($this_page))
    {

//Узнать количество записей в таблице
        //$res      = mysql_query("SELECT count(*) AS count FROM $tb");
        //$row      = mysql_fetch_assoc($res);
        //$rows_max = $row['count']; //количество записей в таблице
        $rows_max = $app['db']->count($tb);
//echo '$rows_max='.$rows_max;

        $show_pages = 10; // Сколько записей покажем пользователю

        $total_page = ceil($rows_max / $show_pages); //Всего страниц (Округляем в большую сторону)
//$rows_last_page = $total_page*$show_pages-$rows_max;//Коректор Количества записей на последней странице

        if ($app['url'] == '')
        { // Устанавливаем ПЕРВУЮ /*последнюю*/ страницу, если не передан параметр
            //$this_page=$total_page;
            $this_page = 1;
        }

        if ($this_page > $total_page || $this_page < 1)
            echo $this->p404(); // проверка
        else
        {
            $app['title']    = 'Блог';
            //$app['descript'] = '';
            $app['keywords'] = 'блог, blog,';

            if ($total_page > 1)
            {
                $pag = '';
                for ($x = 0; $x++ < $total_page;)
                {// Выводит (12345678910) ссылки пагинации
                    if ($x == $this_page)
                        $border = 'border:1px solid #ccc;';
                    else
                        $border = '';

                    if ($x == 1)
                        $z = '';
                    else
                        $z = '-' . $x;

                    $pag .= '<a style="padding:5px;margin:5px;' . $border . '" href="/' . $app['component'] . $z . '/">' . $x . '</a>';
                }
                $pag = '<div style="float:left;width:99%;font-size: 12pt;padding:5px;margin-bottom:5px;text-align:center;">' . $pag . '</div>';
            }
            else
                $pag    = '';
            //$offset = (($total_page - $this_page) * $show_pages)-$rows_last_page; //вычисляем смещение и корректируем его
            $offset = (($this_page * $show_pages) - $show_pages); //вычисляем смещение
            /*
              if ($offset<0) {
              $show_pages=$show_pages+$offset;
              $offset=0;
              } */

            /* echo '$rows_last_page='.$rows_last_page.'<br/>';
              echo '$offset='.$offset.'<br/>';
              echo '$show_pages='.$show_pages.'<br/>'; */

            //$res = mysql_query("SELECT * FROM $tb ORDER BY id DESC LIMIT $offset,$show_pages"); //WHERE ");
            $res = $app['db']->select($tb, '*', ['ORDER' => ['id' => 'DESC'], 'LIMIT' => [$offset, $show_pages]]);
            //if (mysql_num_rows($res))
            if (!empty($res))
            {
                $list = '';
                //while ($row  = mysql_fetch_array($res))
                foreach ($res as $row)
                {
                    $id = $row['id'];

                    if (file_exists($app['root'] . '/img/blog/' . $id . '_100.jpg')) //$img = '<img src="/img/blog/'.$id.'_100.jpg" style="margin:5px;float:left;" alt=""/>';
                        $img  = '<div class="img100" style="background:url(/img/blog/' . $id . '_100.jpg) center center no-repeat;"></div>';
                    else
                        $img  = '';
                    $list .= '<div class="anons">';
                    $list .= $img;
                    $list .= '<div  style="margin-left:120px;text-align: justify;">';
                    $list .= '<a href="/blog-' . $row['link'] . '.html">' . $row['title'] . '</a><br/>';
                    $list .= $row['anons'] . '</div></div>';
                }
            }
            echo $pag . $list . $pag;
        }
    } else
    {

        //$url = mysql_real_escape_string(substr($GLOBALS['url'], 1)); // убираем слеш впереди
        $url = substr($app['url'], 1); // убираем слеш впереди
// если URL содержит '.html' на конце, удаляем его
//if (substr($url, -5)=='.html') 
        $url = substr($url, 0, -5); //удаляем '.html' на конце
        //$res = mysql_query("SELECT * FROM $tb WHERE link='$url' LIMIT 1");
        $res = $app['db']->get($tb, '*', ['link' => $url]);
        //if (mysql_num_rows($res))
        if (!empty($res))
        {
            $row = $res; // mysql_fetch_array($res);

            $id              = $row['id'];
            $app['title']    = $row['title'];
            //$GLOBALS['descript'] = '';
            $app['keywords'] = $row['tags'];

            if (file_exists($app['root'] . '/img/blog/' . $id . '_200.jpg'))
                $img = '<img src="/img/blog/' . $id . '_200.jpg" style="margin:0 10px 10px 0;float:left;" alt="' . $row['title'] . '"/>';
            //$img = '<div style="margin:0 10px 10px 0;width:210px;height:210px;background:url(/img/blog/'.$id.'_200.jpg) center center no-repeat;outline:1px solid #ccc;float:left;"></div>';
            else
                $img = '';
            //echo $img.'<h1 style="text-align:center;">'.$row['title'].'</h1>'.$row['text'];

            /** Модификация для SAPE - START */

            if (isset($app['sape_context'])) {
                $sape_context = $app['sape_context'];
                $text = $sape_context->replace_in_text_segment($row['text']);
            } else {
                $text = $row['text'];
            }
            /** Модификация для SAPE - END */

            echo $img . '<h1 style="text-align:center;">' . $row['title'] . '</h1>' . $text;

            // комментарии:
            $bid = $row['id'];
            $tb  = $app['TAB_COMM'];

            //$res = mysql_query("SELECT * FROM $tb WHERE id_blog='$bid' AND aktive='1' ORDER BY id");
            $res = $app['db']->select($tb, '*', ['AND' => ['id_blog' => $bid, 'aktive' => 1], 'ORDER' => 'id']);

            //if (mysql_num_rows($res))
            if (!empty($res))
            {
                $comm = '<h1 style="margin:10px 0;">Комментарии:</h1>';
                //while ($row  = mysql_fetch_array($res))
                foreach ($res as $row)
                {
                    $comm .= '<div class="bx" style="margin: 10px 0;padding:10px;"><h2 style="margin-bottom:5px;">' . $row['name'] . '</h2>' . nl2br($row['comment']) . '</div>';
                }
            }
            echo $comm;

            $_url = dirname(__FILE__) . '/comment_form.php';
            if (file_exists($_url))
                include $_url;
        }
        else
            echo $this->p404();
    }
}



