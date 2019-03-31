<?
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	$url  = $_GET["url"];
	
	// если на конце url '.cssc' или '.jsc' удаляим "c" в конце.
	if (substr($url, -5)=='.cssc' || substr($url, -4)=='.jsc') $url = substr($url, 0, -1);
	
	$expurl = explode ("/",$url); // раскладываем url
	
	$file  = array_pop($expurl);
	
 
	
	$dir   = $root."/".str_replace($file, '', $url);

	echo "url: " . $url . " | dir:" . $dir . " | file: " . $file;

?>