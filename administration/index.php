<?php
defined('PROTECT') or die('Restricted access');

//$alang = file (dirname(__FILE__).'/admin_'.LNG .'.lng');
//$alang = lng(dirname(__FILE__));

if (defined('ADMIN'))
{
    $gurl = dirname(__FILE__) . '/pages/index.php';
    if (file_exists($gurl))
        include $gurl;
    else
        echo $this->p404();
}
else
{
    // функци¤ авторизации login ( первый параметр название таблицы в базе, второй параметр admin или user)
    $this->login('admin');
}
