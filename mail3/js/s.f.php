<?php
ob_start("ob_gzhandler");

// Получаем кодировку
$encoding = $_GET['c'];

// открываем js файл
$value = file_get_contents (dirname(__FILE__).'/s.all.p.js');

// Перекодируем из UTF-8 
//echo $value;// =
if (strcasecmp($encoding, "UTF-8") == 0) // сравниваем строки (сравниваем кодировки) если == 0 (одинаковые)
{
	echo $value;
}
else
{
	header('Content-Type: text/html; charset='.$encoding , true);
	echo iconv("UTF-8", $encoding, $value);
}

/** При перекодировании из некоторых кодировок (например из ISO-8859-1) в UTF-8, 
 *  в результате получается строка в html-кодах.
 *  Чтобы это исправить воспользуемся функцией html_entity_decode
 */
//$value = html_entity_decode($value, ENT_NOQUOTES, "UTF-8");

?>