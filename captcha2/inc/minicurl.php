<?
//$time_start = microtime(1);/* Засекаем время */
//defined( 'PROTECT' ) or die( 'Restricted access' );
//

//require dirname(__FILE__).'/a.charset.php'; // Универсальный перекодировщик

class miniCURL {

  protected $host = '';
  protected $get = '/';
  protected $gzip = '';
  protected $useragent = '';
  protected $referer = '';
  protected $cookies = '';
  
  protected $pstart = '';
  //protected $pstop = '';
  protected $pend = '';
  
  //protected $redirects = true;
  protected $maxredirect = 100;
  
 //protected $header = false;
  protected $nobody = false;
  
  protected $first = '';//first line
  protected $hout = '';
  protected $head = '';
  protected $body = '';
  
  // методы:
  function GetValue($var) {
    return $this->$var;
  }
  
  function SetValue($var,$val) {
    $this->$var = $val;
  }
  
  function SetURL ($url) {
    
    if (substr(trim($url),0,4) == "http")
    {
    $url = trim(substr(strstr($url.' ','://'),3,-1));
    }
    if (strpos ($url, "/") === false) $url .= "/";
    $newget  = strstr($url, "/");
    $newhost = str_replace($newget, '', $url);
    $this->host = $newhost;
    $this->get = $newget;
    
    //echo $url."\n";
  }
  
  function SetGzip ($val) {
    
    if ($val) $this->gzip = "Accept-Encoding: deflate, gzip\r\n";
    else $this->gzip = '';
  }
  
  function SetHost ($val) {
    $this->host = $val;
  }
  
  function SetGET ($val) {
    $this->get = $val;
  }
  
  function SetUserAgent ($val) {
    $this->useragent = "User-Agent: ".$val."\r\n";
  }
  
  function SetReferer ($val) {
    $this->referer = "Referer: ".$val."\r\n";
  }
  function GetReferer () {
    return $this->getstr ($this->referer,"Referer: ","\r\n");
  }
  
  function SetCookies ($val) {
    if (substr(trim($val),-1) == ";") $val = substr(trim($val),0,-1);
    $this->cookies = "Cookie: ".$val."\r\n";
  }
  function GetCookies () {
    return $this->getstr ($this->cookies,"Cookie: ","\r\n");
  }
  
  function SetMaxRedirect ($val) {
    $this->maxredirect = $val;
  }
  
  function SetNoBody ($val) {
    $this->nobody = $val;
  }
  
function GetPage ()//,$ss,$se,$sb)
{
  $fp = fsockopen($this->host, 80, $errno, $errstr, 30);
  
  if ($fp)
    {
    $this->hout  = "GET ".$this->get ." HTTP/1.1\r\n";
    $this->hout .= $this->useragent;
    $this->hout .= "Host: ".$this->host ."\r\n";
    $this->hout .= $this->gzip;
    $this->hout .= $this->referer;
    $this->hout .= $this->cookies;
    //$this->hout .= "Accept: */*\r\n";
    $this->hout .= "Connection: Close\r\n\r\n";
      
    fwrite($fp, $this->hout);
      
    $this->SetReferer("http://".$this->host .$this->get);
    
    $headflag = true;
    $rd = false;
    $str = 0;
    $tmpdata = '';
     
    $data = fgets($fp, 64); // загружаем первую строчку !
    //$data = gzread($fp, 128);
    $this->first = trim($data);
    
    if ($this->maxredirect && (stripos ($data, "301") !==false || stripos ($data, "302") !== false)) $redir = true; else $redir = false;
    $this->maxredirect--;
    
    while (!feof($fp))
      {
        
        if ($str) $data = fgets($fp, 128); else $str++;
        //if ($str) $data = gzread($fp, 128); else $str++;
        
        if ($headflag)
        {
          if ($data == "\r\n")
          {
          // Cookies-----------------------------------
          if (strpos($this->head, "Set-Cookie:") !==false)
          {
            $setcookie = $this->getstr ($this->head,"Set-Cookie: ","\r\n");
            
            //$setcookie = strstr($data," ");
            //echo "\n$setcookie=".$setcookie;
            $arrsetcookie = explode (";",$setcookie);
            $newcookie = '';
            foreach ($arrsetcookie as $asc)
            {
              //echo "\n".$asc;
              if (strpos($asc, "domain=")===false && strpos($asc, "path=")===false && strpos($asc, "expires=")===false)
              {
                $newcookie .= trim($asc).'; ';
              }
            }
            
            if ($this->cookies != '')
            {
              $cookie = $this->getstr ($this->cookies,"Cookie: ","\r\n");
              
              $arrcookie = explode (";",$cookie);
              foreach ($arrcookie as $ac)
              {
                $acookie = explode ("=",trim($ac));
                if (strpos($newcookie, $acookie[0]."=")===false)
                {
                  $newcookie .= $acookie[0]."=".$acookie[1]."; ";
                }
              }
            }
            
            $this->SetCookies($newcookie);
          }
          // Редиректы --------------------------------
          if ($redir && strpos($this->head, "Location:") !==false)
          {
            $newurl = $this->getstr ($this->head,"Location: ","\r\n");
            $this->SetURL (trim($newurl));
            $this->head = '';
            $this->body = '';
            $this->GetPage ();
            break;
          }
        // ------------------------------------------
            $headflag = false;
          }
          $this->head .= $data;
        }
        else if (!$this->nobody)
        {
          $this->body .= $tmpdata;
          $tmpdata = $data;
          if ($this->pend !='' && strpos($tmpdata.$data, $this->pend) !==false) break; 
        }
        else break;
        //}
      }
      if ($this->pend !='') $this->body .= $tmpdata; //
      if ($this->pstart !='') $this->body = strstr($this->body, $this->pstart);; //
    fclose($fp);
      //echo "\n***\n".$this->hout ."\n***\n".$this->head ."\n***\n" .$this->cookies ."\n***\n";
    if ($this->gzip != '')
    {
    if(stripos($this->head, "Content-Encoding: gzip") !== false)
    {
      /*$pos = strpos ($this->body, "\r\n");
      if ($pos !== false)
      {
        $this->body = trim(strstr($this->body,"‹"));//\r\n"));
        $pos2 = strrpos ($this->body, "\r\n");
        if ($pos2 !== false) $this->body = substr($this->body,0, $pos2);
      }
      $this->body=gzinflate(substr($this->body,10,-1));*/
      //$this->body=gzinflate($body);
    //gzuncompress()// zlib
    }
    }
    /*if (!$rd)
    {
      if ($unithout) $data = $out.$data;
      if ($unithead) $data = $head;
      if ($this->unitbody) $data .= $body;
    }
    return $data;*/
    }
    else
    {
      $this->body = "$errstr ($errno)\n";
    }
    
    
}
function getstr ($data,$start,$end)
{
  $data = strstr($data, $start);
  $sl = strlen($start);
  $pos = strpos($data, $end)-$sl;
  $res = substr($data,$sl, $pos);
  return $res;
}
}

/*
function getistr ($data,$start,$end,$all)
{
  
  
  $data = stristr($data, $start);
  $sl = strlen($start);
  $pos = stripos($data, $end)-$sl;
  $res = substr($data,$sl, $pos);
  
  
  
  if ($all)
  {
    $el = strlen($end);
    $data = substr($data.' ',$pos+$el, -1);
    if (stripos($data, $start) !== false) $res .= getistr ($data,$start,$end,$all);
  }
  return $res;
}

//bar-navig.yandex.ru/u?ver=2&show=32&url=http://google.ru

$url = $_POST['host'];
$get = $_POST['get'];
$useragent = 'Mozilla/4.0 (compatible; GoogleToolbar 2.0.114-big; Windows XP 5.1)';
$referer = '';
$cookie = '';
$unit = 'oh'; // o - out head, h - head, b - body, hb - head + body, ohb - out head + head + body
$redirects = 1;

$mc = new miniCURL(); // Создаем объект класса
$mc -> SetURL($url); // URL
$mc -> SetUserAgent('Mozilla/4.0 (compatible/; GoogleToolbar 2.0.114-big; Windows XP 5.1)'); // User Agent
$mc -> SetGzip(false); // 
//$mc -> SetReferer(''); // Передать Referer
//$mc -> SetCookies(''); // Передать Cookies
//$mc -> SetMaxRedirect(0); // Не переходить по редиректам (Максимальное количество редиректов)
//$mc -> SetNoBody(true); // Не возвращать Body документа
//$mc -> SetValue("pstart", "<form"); // Если указано, выдает документ начиная с указанной строки !
//$mc -> SetValue("pend", "</form>"); // Обравает закачку страници обнаружив в документе указанную строку !
$mc -> GetPage(); // Запрос страницы

$hout=$mc -> GetValue("hout"); // Поучить отправляемые заголовки
$head=$mc -> GetValue("head"); // Поучить заголовки ответа
$html=$mc -> GetValue("body"); // Получить страницу



echo $hout.$head.$html;//charset_x_win($html);
echo "\n".'<br/><br/><br/>TIME: '.round(microtime(1) - $time_start, 6);
*/
?>