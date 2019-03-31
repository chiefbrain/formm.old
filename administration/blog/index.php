<?php

defined('ADMIN') or die('Restricted access');

define('USERS', 1); //defined( 'USERS' ) or die( 'Restricted access' );

$tb = $app['TAB_BLOG'];
$info = 'admininfo';
$dir = 'blog';

$lang = $this->lng(dirname(__FILE__));

function imgs($iid, $root)
{
    $basePath = $root . '/img/blog/';
    $flist = glob($basePath . 'tmp/*.jpg');
    if (count($flist) == 3)
    {
        foreach ($flist as $img)
        {
            $rest = substr($img, -7);

            if ($rest == '_50.jpg')
            {
                copy($img, $basePath . $iid . '_50.jpg');
            }

            if ($rest == '100.jpg')
            {
                copy($img, $basePath . $iid . '_100.jpg');
            }

            if ($rest == '200.jpg')
            {
                copy($img, $basePath . $iid . '_200.jpg');
            }

            if (file_exists($img) && is_file($img))
            {
                unlink($img);
            }
        }
    }
}

$check_report = '';

$id = false;
if (isset($app['detail_url'][1]))
{
    $id = $app['detail_url'][1];
}

/*
  function mr ($str) {
  return mysql_real_escape_string($str);
  }
 */

$title = '';
$link = '';
$tags = '';
$anons = '';
$text = '';
$action = '';

if (isset($_POST['title']))
{
    $title = $_POST['title'];
}

if (isset($_POST['link']))
{
    $link = $_POST['link'];
}

if (isset($_POST['tags']))
{
    $tags = $_POST['tags'];
}

if (isset($_POST['anons']))
{
    $anons = $_POST['anons'];
}

if (isset($_POST['text']))
{
    $text = $_POST['text'];
}

if (isset($_POST['action']))
{
    $action = $_POST['action'];
}


if ($action == 'add' || $action == 'edit')
{
    //$id=mysql_real_escape_string($_POST['id']);

    $_check = true;
    $check_title = true;
    $check_link = true;


    /* проверка */
    if ($title == '' || $link == '' || $anons == '' || $text == '')
    {
        $_check = false;
    }

    //$res = mysql_query("SELECT * FROM $tb WHERE id!='$id' AND title='$title'"); //WHERE ");
    //if (mysql_num_rows($res))


    if ($action == 'add' && $app['db']->has($tb, ['title' => $title]))
    {
        $check_title = false;
    }
    else if ($action == 'edit' && $app['db']->has($tb, ['AND' => ['id[!]' => $id, 'title' => $title]]))
    {
        $check_title = false;
    }

    //$res = mysql_query("SELECT * FROM $tb WHERE id!='$id' AND link='$link'"); //WHERE ");
    //if (mysql_num_rows($res))
    if ($action == 'add' && $app['db']->has($tb, ['link' => $link]))
    {
        $check_link = false;
    }
    else if ($action == 'edit' && $app['db']->has($tb, ['AND' => ['id[!]' => $id, 'link' => $link]]))
    {
        $check_link = false;
    }

    if ($check_title && $check_link && $_check)
    {
        $check = true;
    }
    else
    {

        $check = false;
        if ($check_title)
        {
            $title_report = '';
        }
        else
        {
            $title_report = $lang[6];
        }

        if ($check_link)
        {
            $link_report = '';
        }
        else
        {
            $link_report = $lang[7];
        }

        if ($_check)
        {
            $_report = '';
        }
        else
        {
            $_report = $lang[8];
        }

        $check_report = '<strong style="color:red;"><br/>' . $title_report . ' ' . $link_report . '<br/>' . $_report . '</strong>';
    }
}

if ($action == 'add' && $check)
{
    $app['db']->insert($tb, ['title' => $title, 'link' => $link, 'tags' => $tags, 'anons' => $anons, 'text' => $text]);
    $app['debug']->db();

    $iid = $app['db']->id();


    //if (mysql_query("INSERT INTO $tb (title,link,tags,anons,text) VALUES ('$title','$link','$tags','$anons','$text')"))
    //{
    //    $iid = mysql_insert_id();
    imgs($iid, $app['root']); // Сохраняем изображение
    $this->report('Edited !', '/' . $app['codeword'] . '/' . $dir . '/edit-' . $iid, 'green');
    //}
    //else
    //    report('Error !', REFERER, 'red');
}
else if ($id && $action == 'edit' && $check)
{
    $app['db']->update($tb, ['title' => $title, 'link' => $link, 'tags' => $tags, 'anons' => $anons, 'text' => $text], ['id' => $id]);
    $app['debug']->db();
    //if (mysql_query("UPDATE $tb SET title='$title',link='$link',tags='$tags',anons='$anons',text='$text' WHERE id=$id"))
    //{
    imgs($id, $app['root']); // Сохраняем изображение
    $this->report('Edited !', $app['REFERER'], 'green');
    //}
    //else
    //    report('Error !', REFERER, 'red');
}
else if ($id && $action == 'del')
{
    $app['db']->delete($tb, ['id' => $id]);
    $app['debug']->db();
    //if (mysql_query("DELETE FROM $tb WHERE id='$id'"))
    //{
    $basePath = $app['root'] . '/img/blog/';
    $flist = glob($basePath . $id . '_*.jpg');
    if (count($flist))
    {
        foreach ($flist as $img)
        {
            if (file_exists($img) && is_file($img))
            {
                unlink($img);
            }
        }
    }
    $this->report('Removed !', '/' . $app['codeword'] . '/' . $dir . '/', 'red');
    //}
}
else
{
    $_comm = '<img src="/img/unitab/001_30.gif" class="img_block" alt="comment"/>';
    $_plus = '<img src="/img/unitab/001_01.gif" class="img_block" alt="plus" title="Одобрить"/>';
    $_minus = '<img src="/img/unitab/001_02.gif" class="img_block" alt="minus" title="Запретить"/>';
    $_link = '<img src="/img/unitab/001_40.gif" class="img_block" alt="link" title="Посмотреть статью"/>';
    $_add = '<img src="/img/unitab/001_01.gif" class="img_block" alt="add"/>';
    $_back = '<img src="/img/unitab/001_23.gif" class="img_block" alt="back" />';
    $_submit = '<img src="/img/unitab/001_06.gif" class="img_block" style="cursor:pointer;" alt="submit" onclick="forma.submit();" />';
    $_edit = '<img src="/img/unitab/001_45.gif" class="img_block" alt="edit" title="edit"/>';
    $_del = '<img src="/img/unitab/001_05.gif" class="img_block" alt="del" title="del"/>';

    $topmenu2 = '<a href="/' . $app['codeword'] . '/' . $dir . '/">' . $_back . ' BACK</a><br/><br/>';

    $_col1 = '30px'; // Ширина первой колонки
    $_col0 = '50px'; // Ширина последней колонки

    $_url = dirname(__FILE__);

    $this_page = '';
    if (isset($app['detail_url'][0]))
    {
        $this_page = $app['detail_url'][0]; // Номер текущей страницы
    }

//if ($GLOBALS['url']=='') $_url .= '/list.php'; else $_url .= $GLOBALS['url'].'.php';
    if ($this_page == '' || ctype_digit($this_page))
    {
        $_url .= '/list.php';
    }
    else
    {
        $_url .= '/' . $this_page . '.php';
    }

    if (file_exists($_url))
    {
        include $_url;
    }
    else
    {
        echo $this->p404();
    }
}