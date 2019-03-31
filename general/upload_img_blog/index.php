<?
error_reporting(E_ALL);

session_start();
if (isset($_SESSION['admin'])) define( 'ADMIN', $_SESSION['admin']);
defined( 'ADMIN' ) or die( 'Restricted access' );
define( 'PROTECT', 1 ); //defined( 'PROTECT' ) or die( 'Restricted access' );

//echo  dirname(__FILE__);

$root = str_replace('/general/upload_img_blog', '', dirname(__FILE__));
//$root  = '/home/private/data/www/tmp.formm.ru';
define( 'ROOT' , $root);

//define( 'ROOT' , $_SERVER['DOCUMENT_ROOT']);

require ROOT .'/includes/index/function.php'; // Функции и Подключение к БД и Другие...
//include '/includes/index/function.php'; // Функции и Подключение к БД и Другие...
define( 'REFERER', $_SERVER['HTTP_REFERER']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> img blog </title>
</head>
<body>
<?

$action = $_GET['action'];
$img = $_GET['img'];
$id = $_GET['id'];
//$g = $_GET['g'];

	//$baseName = $g.'_'.$tid.'_';
	$basePath = ROOT .'/img/blog/';
	//$preview = 'preview/';
/*
if ($action=='del')
{
	
	$flist = glob($basePath.$id.'_*.jpg');
	if (count($flist))
	{
		foreach ($flist as $img) {
			//echo $img.'<br/>';
			if (file_exists($img) && is_file($img)) unlink ($img);
		}
	}
	
	$img = $_GET['img'];
	
	if (file_exists($basePath.$img)) unlink ($basePath.$img);
	if (file_exists($basePath.$preview.$img)) unlink ($basePath.$preview.$img);
	report('Изображение удалено !!!' ,'/general/upload/index.php?action=edit&tid='.$tid.'&g='.$g,'red');
}
else
{*/
	
//$img_del = '<img src="/img/unitab/001_05.gif" style="width:16px;height:16px;" alt="del" title="удалить" />';
	/*if ($id!='') {
		$imdi .= '<img src="'.$basePath.$id.'_100.jpg" style="margin:5px 20px;" alt="" />';
	} else {*/
if (file_exists($basePath.$id.'_100.jpg')) {
		
		$imdi .= '<img src="/img/blog/'.$id.'_100.jpg?'.time().'" style="margin:5px 20px;" alt="" />';
		
	} else {
		
	$flist = glob($basePath.'tmp/*_100.jpg');
	if (count($flist))
	{
		//sort ($flist); // Сортируем массив с именами файлов
		foreach ($flist as $img) {
			$img= str_replace($basePath.'tmp/', '', $img); // Удаляем лишнее в начале
			$imgfon='/img/blog/tmp/'.$img.'?'.time();
			//$hei='180';
			$imdi .= '<img src="'.$imgfon.'" style="margin:5px 20px;" alt="" />';
			/*$imdi .= '<div style="width:'.$hei.'px;height:100px;background:url('.$imgfon.') center center no-repeat;border:1px solid #000;margin:5px;float:right;">
<a href="?action=del&amp;img='.$img.'&amp;tid='.$tid.'&amp;g='.$g.'">'.$img_del.'</a>
</div>';*/
		}
	}
	
	}
	//}

?>
<div style="float:left;margin:5px;">
<form action="/general/upload_img_blog/upload.php?id=<?echo $id;?>" method="post" enctype="multipart/form-data">
<input size="18" type="file" name="img" />
<br/>
<input style="width:200px;" type="submit" value="download" />
</form>
<form action="/general/upload_img_blog/upload.php?action=remove&amp;id=<?echo $id;?>" method="post">
<input style="width:200px;" type="submit" value="remove" />
</form>
</div>
<?
//echo '<div style="overflow:auto;float:left;width:100%;height:170px;">'.$imdi.'</div>';
echo $imdi;
//}

?>

</body>
</html>
