<?
require dirname(__FILE__).'/inc/minicurl.php'; // грузим class
session_start();

function getRequest() {
  $length = rand(8,20); // длина соли (от 5 до 10 сомволов)
  $salt = '';
  for($i=0; $i<$length; $i++)
  {
    $salt .= chr(rand(33,126)); // символ из ASCII-table
  }
  return $salt;
}

function getRegion() {
  $reg = rand(1,102); // число
  $exceptions = "27,29,31,32,34,60,61,69,70,71,72,81,82,83,85,89,92,"; // исключения
  if (strpos($exceptions, $reg.",") === false) return $reg;
  else return getRegion();
}

function getCaptcha($getCapMax) {

  $url = "yandex.ru/yandsearch?p=".rand(1,10)."&numdoc=50&text=".getRequest()."&lr=".getRegion();

  $mc = new miniCURL(); // Создаем объект класса
  $mc -> SetURL($url); // URL
  //$mc -> SetUserAgent('Mozilla/4.0 (compatible/; GoogleToolbar 2.0.114-big; Windows XP 5.1)'); // User Agent
  //$mc -> SetGzip(false); // ПОКА НЕ РАБОТАЕТ
  //$mc -> SetReferer(''); // Передать Referer
  //$mc -> SetCookies(''); // Передать Cookies
  //$mc -> SetMaxRedirect(0); // Не переходить по редиректам (Максимальное количество редиректов)
  //$mc -> SetNoBody(true); // Не возвращать Body документа
  $mc -> SetValue("pstart", "<form"); // Если указано, выдает документ начиная с указанной строки !
  $mc -> SetValue("pend", "</form>"); // Обравает закачку страници обнаружив в документе указанную строку !
  $mc -> GetPage(); // Запрос страницы

  //$hout=$mc -> GetValue("hout"); // Поучить отправляемые заголовки
  //$head=$mc -> GetValue("head"); // Поучить заголовки ответа
  $html=$mc -> GetValue("body"); // Получить страницу

  //echo $html;

// 1 ----------------------------------------------------

  $cap = $mc -> getstr ($html,'<img src="http://yandex.ru/captchaimg?',',,');
  $cap = base64_decode($cap);

// 2 ----------------------------------------------------

  $key = $mc -> getstr ($html,'<input type="hidden" name="key" value="','">');

// 3 ----------------------------------------------------

  $retpath = $mc -> getstr ($html,'<input type="hidden" name="retpath" value="','">');



  if ($cap != '' && $key != '' && $retpath != '')
  {
  ##########################################################################
    $img = @imagecreatefromgif($cap);
    $color = imagecolorallocate ($img, 255, 255, 255);
    imagefilledrectangle ($img, 165, 0, 200, 13, $color);
    imagefilledrectangle ($img, 177, 13, 182, 15, $color);
    imagesetpixel ($img, 164, 12, $color);
  
    $img2 = @imagecreate (180, 60);
    imagecopy ($img2, $img, 0, 0, 0, 0, 180, 60);
    //imagegif ($img2,dirname(__FILE__).'/cap.gif');
    header ("Content-type: image/gif");
    imagegif ($img2);
  ##########################################################################
  
    $_SESSION['captcha_key'] = $key;
    $_SESSION['captcha_retpath'] = $retpath;
    $_SESSION['captcha_cookies'] = $mc -> GetCookies();
    $_SESSION['captcha_referer'] = $mc -> GetReferer();
  }
  else
  {
    if ($getCapMax--)
    {
      getCaptcha($getCapMax);
    }
    else
    {
      $error = dirname(__FILE__)."/img/error.gif";
      $img = @imagecreatefromgif($error);
      header ("Content-type: image/gif");
      imagegif ($img);
    }
  }
}


getCaptcha(10); // Цифра - максимальное число повторных запросов при ошибке



?>