<?php
defined('PROTECT') or die('Restricted access');

//session_start();
//$lang = file (dirname(__FILE__).'/alogin_'.LNG .'.lng');
$lang = $this->lng(dirname(__FILE__));

if (count($_POST) > 0) {
    if ($UserType == 'admin') {
        $tabDB = $app['TAB_ADMIN']; // таблица јдминов
        $info = 'admininfo';
    } else if ($UserType == 'user') {
        $tabDB = $app['TAB_USER']; // таблица ёзеров
        $info = 'userinfo';
    }

    setcookie("login", $_POST['login'], time() + 10);

    if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']) {
        //$login    = mysql_real_escape_string($_POST['login']);
        $login = $_POST['login'];
        $password = $_POST['password'];

        //$res = mysql_query("SELECT * FROM $tabDB WHERE login='$login' LIMIT 1");
        $res = $app['db']->get($tabDB, '*', ['login' => $login]);
        //if (mysql_num_rows($res))
        if (!empty($res)) {
            $row = $res; //mysql_fetch_array($res);
            if (md5(md5($password) . $row['salt']) == $row['password']) {
                setcookie('login', '', time() - 10);
                /* $_SESSION['login'] = $row['login'];
                  $_SESSION['access'] = $row['access'];
                  $_SESSION['type'] = $UserType; */
                $_SESSION[$UserType] = $row['login'];
                /*
                  $fields  = mysql_list_fields($app['db_name'], $tabDB); // список колонок таблицы
                  $columns = mysql_num_fields($fields);
                  for ($i = 0; $i < $columns; $i++)
                  {
                  $fname       = mysql_field_name($fields, $i);
                  if ($fname != 'password' && $fname != 'salt' && $fname != 'access')
                  $inf[$fname] = $row[$fname];
                  } */

                unset($row['password'], $row['salt'], $row['access']);

                $_SESSION[$info] = $row;


                $err = false;
            } else
                $err = true;
        } else
            $err = true;
    } else
        $err = true;

    unset($_SESSION['captcha_keystring']);

    if ($err) {
        $_SESSION['err_login'] = 1;
        $this->report($lang[4], '/admin/', 'red'); //ќшибка авторизации!
    } else {
        $this->report($lang[3], $app['REFERER'], 'green'); //јвторизаци¤ прошла успешно!
    }
} else {
    $alogin = '';
    if (isset($_COOKIE['alogin']))
    {
        $alogin = $_COOKIE['alogin'];
    }
    setcookie('alogin', '', time() - 10);
    ?>
    <div style="width:100%;float:left;padding:10px;">
        <p style="text-align:center;padding:10px;"><?= $lang[5]; ?></p>
        <div style="margin-left:50%;position:relative; left:-100px; width:200px;">
            <form name="falogin" action="" method="post">


                <p><?= $lang[0]; ?></p>
                <input name="login" type="text" value="<?= $alogin; ?>" maxlength="50" style="width:200px;height:20px;margin:3px 0 5px 0;" />



                <p style="padding:3px"><?= $lang[1]; ?></p>
                <input name="password" type="password" maxlength="50" style="width:200px;height:20px;margin:3px 0 5px 0;" />


                <table style="width:100%;">
                    <tr>
                        <td><img src="/captcha/" alt="captcha" border="0" onclick="this.src = '/captcha/?' + icap++;" style="cursor:pointer;" title="<?= $lang[6]; ?>" /></td>
                        <td style="padding-left:3px;"><?= $lang[2]; ?></td>
                    </tr>
                </table>

                <input name="keystring" maxlength="6" type="text" style="width:200px;height:20px;margin:3px 0 5px 0;" />

                <div style="width:50px;height:17px;background:#000;color:#fff;border:1px solid #000;text-align:center;padding-top:3px;cursor:pointer;" onclick="falogin.submit();"> LOGIN </div>


                <input type="submit" style="display: none;" />

            </form>
        </div>
    </div>
    <?php
}
?>