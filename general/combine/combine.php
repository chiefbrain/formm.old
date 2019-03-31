<?php
	
	$pref = ".comb";
	
	$cache  = true;
	$optim  = true;
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	$cachedir =  dirname(__FILE__) . '/cache';
	
	$type  = $_GET['type'];
	$url  = $_GET["url"];
	
	//$url = str_replace(".jjj", '.js', $url);
	
	// если на конце url '.cssc' или '.jsc' удал¤им "c" в конце.
	//if (substr($url, -5)=='.css'.$pref || substr($url, -4)=='.js'.$pref) $url = substr($url, 0, -1);
	if (substr($url, -5)==$pref) $url = substr($url, 0, -5);
	
	//$url = substr($url, 1); // удал¤ем '/' перед url
	$expurl = explode ("/",$url); // раскладываем url
	
	$file  = array_pop($expurl);
	
	$dir   = $root."/".str_replace($file, '', $url);
	
	//echo "/* file = ".$file." dir = ".$dir." */";
	
	if (isset($_GET['p']))
	{
		$p = $_GET['p'];
		$c = $_GET['c'];
		if ($type=='css') $get = '?'.$p; else $get='?'.$c; // ???????!!!!!!!!!!!
		$php = true;
	}
	else
	{
		$p = '';
		$c = '';
		$get = '';
		$php = false;
	}
	
	//echo '$_GET["type"] = "'.$_GET['type'].'" | $_GET["dir"] = '.$_GET['dir'].' | $_GET["file"] = '.$_GET['file'].'<br/>';
	
	// ѕровер¤ем тип
	// Determine the directory and type we should use
	switch ($type)
	{
		case 'css':
			//$base = realpath($cssdir);
			break;
		case 'js':
			//$base = realpath($jsdir);
			break;
		default:
			header ("HTTP/1.1 501 Not Implemented");
			exit;
	}
	/*if ($type == '' || $type != 'css' || $type != 'js')
	{
		header ("HTTP/1.1 501 Not Implemented");
		exit;
	}*/
	
	// заносим в массив все файлы указанные через ","
	$elements = explode(',', $file);
	
	// Determine last modification date of the files
	// ќпределить дату последней модификации файла
	$lastmodified = 0;
	//while (list(,$element) = each($elements)) {
	foreach ($elements as $element)
	{
		$path = realpath($dir . '/' . $element);
	//echo $element;exit;
		if (($type == 'js' && substr($path, -3) != '.js') || 
			($type == 'css' && substr($path, -4) != '.css')) {
			
			header ("HTTP/1.1 403 Forbidden");
			exit;
		}
	
		if (/*substr($path, 0, strlen($dir)) != $dir ||*/ !file_exists($path)) {
			header ("HTTP/1.1 404 Not Found");
			exit;
		}
		
		$lastmodified = max($lastmodified, filemtime($path));
	}
	
	// Send Etag hash
	$hash = $lastmodified . '-' . md5($url);
	header ("Etag: \"" . $hash . "\"");
	
	if ( $cache && isset($_SERVER['HTTP_IF_NONE_MATCH']) && stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) == '"' . $hash . '"') 
	{
		// Return visit and no modifications, so do not send anything
		header ("HTTP/1.1 304 Not Modified");
		header ('Content-Length: 0');
	} 
	else 
	{
		// First time visit or files were modified
		if ($cache) 
		{
			// Determine supported compression method
			$gzip = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
			$deflate = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate');
	
			// Determine used compression method
			$encoding = $gzip ? 'gzip' : ($deflate ? 'deflate' : 'none');
	
			// Check for buggy versions of Internet Explorer
			if (!strstr($_SERVER['HTTP_USER_AGENT'], 'Opera') && 
				preg_match('/^Mozilla\/4\.0 \(compatible; MSIE ([0-9]\.[0-9])/i', $_SERVER['HTTP_USER_AGENT'], $matches)) {
				$version = floatval($matches[1]);
				
				if ($version < 6)
					$encoding = 'none';
					
				if ($version == 6 && !strstr($_SERVER['HTTP_USER_AGENT'], 'EV1')) 
					$encoding = 'none';
			}
			
			// Try the cache first to see if the combined files were already generated
			$cachefile = 'cache-' . $hash . '.' . $type . ($encoding != 'none' ? '.' . $encoding : '');
			
			if (file_exists($cachedir . '/' . $cachefile)) {
				if ($fp = fopen($cachedir . '/' . $cachefile, 'rb')) {

					if ($encoding != 'none') {
						header ("Content-Encoding: " . $encoding);
					}
				
					header ("Content-Type: text/" . $type);
					header ("Content-Length: " . filesize($cachedir . '/' . $cachefile));
		
					fpassthru($fp);
					fclose($fp);
					exit;
				}
			}
		}
		// јльтернативна¤ загрузка
		if ($php)
		{
			if ($type == 'js')
			{
				$mi = 2;
			}
			else if ($type == 'css')
			{
				$mi = 3;
			}
			
			$filephp = substr($file,0, -$mi).'php';
			include $dir.'/'.$filephp;
		}
		else
		{
		// Get contents of the files
		$contents = '';
		reset($elements);
		//while (list(,$element) = each($elements)) {
		foreach ($elements as $element)
		{
			$path = realpath($dir . '/' . $element);
			$contents .= file_get_contents($path);
		}
		}

                if ($optim && $type == 'js')
                {
				/*$contents = preg_replace('/\/\*.*\*\//Uis', '', $contents); //”дал¤ем комментарии
                 foreach (explode("\n", $contents) as $tee) {$ct.=trim($tee);}
                 $contents=$ct;*/
                 for ($i = 1; $i < 10; $i++)
                 {
                 $contents = str_replace("\n\n", "\n", $contents); //”дал¤ем переносы строк
                 $contents = str_replace("\r\r", "\r", $contents); //”дал¤ем переносы строк
                 $contents = str_replace("\r\n\r\n", "\r\n", $contents); //”дал¤ем переносы строк
                 }
                }

                if ($optim && $type == 'css')
                {
				$contents = preg_replace('/\/\*.*\*\//Uis', '', $contents); //”дал¤ем комментарии
				
                 /*foreach (explode("\n", $contents) as $tee) {$ct.=trim($tee);}
                 $contents=$ct;*/
                 $contents = str_replace("\r", "", $contents); //”дал¤ем переносы строк
                 $contents = str_replace("\n", "", $contents); //”дал¤ем переносы строк
				 $contents = str_replace(chr(9), "", $contents); //”дал¤ем табул¤цию
				$contents = preg_replace('/\s+/Uis', ' ', $contents); //”дал¤ем лишние пробелы
				
                 //for ($i = 1; $i < 10; $i++)
                 //{
                 
                 $contents = str_replace(" }", "}", $contents); //”дал¤ем пробелы перед }
                 $contents = str_replace(" {", "{", $contents); //”дал¤ем пробелы перед {
                 $contents = str_replace("{ ", "{", $contents); //”дал¤ем пробелы после {
                 $contents = str_replace("} ", "}", $contents); //”дал¤ем пробелы после }
                 $contents = str_replace("; ", ";", $contents); //”дал¤ем пробелы после ;
                 $contents = str_replace(" ;", ";", $contents); //”дал¤ем пробелы перед ;
                 $contents = str_replace(" :", ":", $contents); //”дал¤ем пробелы перед :
                 $contents = str_replace(": ", ":", $contents); //”дал¤ем пробелы после :
                 $contents = str_replace("+ ", "+", $contents); //”дал¤ем пробелы после +
                 $contents = str_replace(" +", "+", $contents); //”дал¤ем пробелы перед +
                 $contents = str_replace("= ", "=", $contents); //”дал¤ем пробелы после =
                 $contents = str_replace(" =", "=", $contents); //”дал¤ем пробелы перед =
                 $contents = str_replace("- ", "-", $contents); //”дал¤ем пробелы после -
                 $contents = str_replace("/ ", "/", $contents); //”дал¤ем пробелы после /
                 $contents = str_replace(" /", "/", $contents); //”дал¤ем пробелы перед /
                 $contents = str_replace(", ", ",", $contents); //”дал¤ем пробелы после ,
                 $contents = str_replace(" ,", ",", $contents); //”дал¤ем пробелы перед ,
                 //$contents = str_replace("  ", " ", $contents); //”дал¤ем двойной пробел
				$contents = str_replace(";}", "}", $contents); //”дал¤ем ; перед }
				$contents = str_replace("; }", "}", $contents); //”дал¤ем ; перед }
                 //}
                }
				$contents = "/* Processed COMBINE !!! " .$p. " */\n".$contents; // ћетка
                // Send Content-Type
		header ("Content-Type: text/" . $type);
		
		if (isset($encoding) && $encoding != 'none') 
		{
			// Send compressed contents
			$contents = gzencode($contents, 3, $gzip ? FORCE_GZIP : FORCE_DEFLATE);
			header ("Content-Encoding: " . $encoding);
			header ('Content-Length: ' . strlen($contents));
			echo $contents;
		} 
		else 
		{
			// Send regular contents
			header ('Content-Length: ' . strlen($contents));
			echo $contents;
		}

		// Store cache
		if ($cache) {
			if ($fp = fopen($cachedir . '/' . $cachefile, 'wb')) {
				fwrite($fp, $contents);
				fclose($fp);
			}
		}
	}
?>	
