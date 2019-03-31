<?php
/** gZip On */
ini_set('zlib.output_compression', 1);
ini_set('zlib.output_compression_level', -1);

// Получаем кодировку
$encoding = $_GET['c'];

// открываем js файл
$value = file_get_contents(dirname(__FILE__) . '/s.all.p.js');

// Перекодируем из UTF-8 

if (strcasecmp($encoding, "UTF-8") == 0) // сравниваем строки (сравниваем кодировки) если == 0 (одинаковые)
{
    header('content-type: application/javascript; charset=utf-8');
    echo $value;
} else {
    header('Content-Type: application/javascript; charset=' . $encoding, true);
    echo iconv("UTF-8", $encoding, $value);
}
