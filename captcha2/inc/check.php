<?
require dirname(__FILE__).'/minicurl.php'; // грузим class
//session_start();

$tb = 'formm_cookies'; // Таблица в БД

if (isset($_REQUEST['captcha']))
{
  
  $url='yandex.ru/checkcaptcha?rep='.$_REQUEST['captcha'].'&key='.$_SESSION['captcha_key'].'&retpath='.$_SESSION['captcha_retpath'];
  
  $mc = new miniCURL(); // Создаем объект класса
  $mc -> SetURL($url); // URL
//$mc -> SetUserAgent('Mozilla/4.0 (compatible/; GoogleToolbar 2.0.114-big; Windows XP 5.1)'); // User Agent
//$mc -> SetGzip(false); // ПОКА НЕ РАБОТАЕТ
  $mc -> SetReferer($_SESSION['captcha_referer']); // Передать Referer
  $mc -> SetCookies($_SESSION['captcha_cookies']); // Передать Cookies
  $mc -> SetMaxRedirect(1); // Не переходить по редиректам (Максимальное количество редиректов)
  $mc -> SetNoBody(true); // Не возвращать Body документа
//$mc -> SetValue("pstart", "<form"); // Если указано, выдает документ начиная с указанной строки !
//$mc -> SetValue("pend", "</form>"); // Обравает закачку страници обнаружив в документе указанную строку !
  $mc -> GetPage(); // Запрос страницы
  
  unset($_SESSION['captcha_key'],$_SESSION['captcha_retpath'],$_REQUEST['captcha']);
  //session_destroy();
  
//$hout=$mc -> GetValue("hout"); // Поучить отправляемые заголовки
  //$head=$mc -> GetValue("head"); // Поучить заголовки ответа
//$html=$mc -> GetValue("body"); // Получить страницу
  $first = $mc -> GetValue("first");//."\n<br/>\n"; // Поучить first line
  $cookies = $mc -> GetCookies();
  
  //echo $first.$cookies;
  
  if (stripos ($first, "200 OK") !==false && stripos ($cookies, "yandexuid=") !==false && stripos ($cookies, "spravka=") !==false)
  {
    mysql_query("INSERT INTO $tb ( date_received,cookies) VALUES ('".gmmktime()."','$cookies')");
    $check_captcha = true;
  }
  else
  {
    $check_captcha = false;
  }
}
//else $check_captcha = false;

?>