<?php

namespace App\Index;

class MyFunction {

    protected $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function report($report, $link, $color, $time = 2) {
        echo '<p style="text-align:center;color:' . $color . ';font-size:large;font-weight:900;padding:20px;">' . $report . '</p>';
        if ($link != '') {
            echo '<script type="text/javascript">/*<![CDATA[*/window.setTimeout(function(){window.location.href = "' . $link . '";}, ' . $time . '000);/*]]>*/</script>';
        }
    }

    public function report2($report, $link, $color, $time = 2) {
        $rep = '<p style="text-align:center;color:' . $color . ';font-size:large;font-weight:900;">' . $report . '</p>';
//if ($link!='') echo '
        ?>
        <script type="text/javascript">/*<![CDATA[*/

            document.getElementById('fon').style.display = 'block';
            document.getElementById('win').innerHTML = '<?= $rep; ?>';
            document.getElementById('win').style.display = 'block';
            window.setTimeout(close_report, <?= $time; ?>000);
            function close_report() {
                //document.getElementById('fon').style.display='none';
                //document.getElementById('win').style.display='none';
                window.location.href = "<?= $link; ?>";
            }
            /*]]>*/</script>
        <?php
        //';
    }

    /*
      function cont ($res) {
      $row=mysql_fetch_array($res);
      return stripslashes($row['content']);
      }
      function sel ($db_tab,$url) {
      return mysql_query("SELECT * FROM $db_tab WHERE link='$url' LIMIT 1");
      }
     */

    public function login($UserType) {
        $app = $this->app;
        include $app['root'] . '/includes/login/login.php';
    }

    public function p404() {
        $app = $this->app;
        header("HTTP/1.0 404 Not Found");
        return file_get_contents($app['root'] . '/data/404.html');
    }

    public function jblock($bloc, $url, $jcont) {
        $app = $this->app;
        $url = $app['root'] . $url;
        
        //return $url;
        
        ob_clean();
        if (file_exists($url)) {
            include($url);
            /* $content=ob_get_contents();
              if(FORMAT=='html' && $bloc=='content' && LEVEL>=7) {
              $content= '<p style="text-align:center;color:green;font-size:100%;font-weight:900;padding:5px;">Вы находитесь в режиме администрирования.</p>
              <form action="/admin/save.php" method="post">
              <script type="text/javascript" src="/general/ckeditor/ckeditor.js"></script>
              <textarea style="display:none;" class="ckeditor" name="content" rows="10" cols="180">'.htmlspecialchars($content).'</textarea>
              <input type="hidden" name="url" value="'.$url.'"/>
              <input type="hidden" name="action" value="action"/>
              <input type="submit" value="submit"/>
              </form>';
              }

              return str_replace('<bloc-'.$bloc.'/>', $content."\n".'<bloc-'.$bloc.'/>', $jcont); */
            return str_replace('<bloc-' . $bloc . '/>', ob_get_contents() . "\n" . '<bloc-' . $bloc . '/>', $jcont);
        } else {
            if ($bloc == 'content') {
                echo $this->p404();
                return str_replace('<bloc-content/>', ob_get_contents(), $jcont);
            } else {
                return str_replace('<bloc-' . $bloc . '/>', '<div style="border:1px solid red; padding:5px;">Block<br/>' . $url . '<br/>not found !</div>', $jcont);
            }
        }
    }

    public function jaddon($add, $url, $jcont) {
        $app = $this->app;
        $url = $app['root'] . $url;
        ob_clean();
        if (file_exists($url)) {
            include($url);
            return str_replace('<add-' . $add . '/>', ob_get_contents(), $jcont);
        } else {
            return str_replace('<add-' . $add . '/>', '<!--Addon: ' . $url . ' not found !-->', $jcont);
        }
    }

    public function lng($dirname, $dop = '') {
        $app = $this->app;
        /* START Подгружаем языковый файл */
        //$url_exp = explode("/", $url);
        //$basecat=$url_exp[count($url_exp)-2];
        $basecat = basename($dirname);
        //echo '##############'.$basecat;
        $file_lng = $dirname . '/' . $basecat . $dop . '_' . $app['languages'] . '.lng';
        //$file_lng_def=$dirname.'/'.$basecat.$dop.'_'.LNG_DEF .'.lng';
        if (file_exists($file_lng)) {
            $lang = file($file_lng);
        }
        //else if (file_exists($file_lng_def)) $lang = file ($file_lng_def);
        return $lang;
        /* END Подгружаем языковый файл */
    }

}
/*
die;

defined('PROTECT') or die('Restricted access');
/* Функция соединения с БД */

/* $db_serv='localhost';
  $db_user='glober_test_sess';
  $db_pass='test_sess';
  $db_name='glober_test_sess'; */
/*
$db_serv = "mysql2.justhost.ru"; //'localhost';
$db_user = "u10627ijf_oka"; //'u10554_formm';
$db_pass = "TR4DBZJ5"; //'qEgSGvDx';
$db_name = "u10627ijf_formm"; //'u10554_formm';

mysql_connect($db_serv, $db_user, $db_pass) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error());
mysql_query("set names utf8");
//mysql_query("set names cp1251");
//define( 'TAB_USERS', 'sat_users' ); // таблица пользователей

$GLOBALS['db_name'] = $db_name;

define('TAB_ADMIN', 'form_admin'); // таблица Админов
define('TAB_FUM', 'form_users_mail'); // таблица пользоавтелей почтового сервиса.
define('TAB_BLOG', 'form_blog'); // таблица 
define('TAB_COMM', 'form_comment'); // таблица 
//define( 'TAB_CATALOG', 'joo_catalog' ); // таблица catalog
// Функции


*/