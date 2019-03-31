<?

session_start();
if (isset($_SESSION['admin'])) define( 'ADMIN', $_SESSION['admin']);
defined( 'ADMIN' ) or die( 'Restricted access' );
define( 'PROTECT', 1 ); //defined( 'PROTECT' ) or die( 'Restricted access' );

$root = str_replace('/general/upload_img_blog', '', dirname(__FILE__));
//$root  = '/home/private/data/www/tmp.formm.ru';
define( 'ROOT' , $root);

//define( 'ROOT' , $_SERVER['DOCUMENT_ROOT']);

require ROOT .'/includes/index/function.php'; // Функции и Подключение к БД и Другие...
define( 'REFERER', $_SERVER['HTTP_REFERER']);

$id = $_GET['id'];

if ($_GET['action']=='remove') {
/*################## - Удаляем все файлы из /img/blog/tmp/ - ########################*/
$basePath = ROOT .'/img/blog/';
$flist = glob($basePath.'tmp/*.*');
	if (count($flist))
	{
		foreach ($flist as $img) {
			//echo $img.'<br/>';
			if (file_exists($img) && is_file($img)) unlink ($img);
		}
	}
/*##################################################################################*/
	
	$flist = glob($basePath.$id.'_*.jpg');
	if (count($flist))
	{
		foreach ($flist as $img) {
			//echo $img.'<br/>';
			if (file_exists($img) && is_file($img)) unlink ($img);
		}
	}
	
report('Картинка удалена !',REFERER,'red');
} else {


$fname=$_FILES['img']['name'];
$tname=$_FILES['img']['tmp_name'];
$ftype=$_FILES['img']['type'];

if ($ftype=='image/gif' || $ftype=='image/jpeg' || $ftype=='image/png' || $ftype=='image/bmp')
{
//$tid = $_GET['tid'];
//$g = $_GET['g'];
	//$baseName = $g.'_'.$tid.'_';
	
	//$preview = 'preview/';
	
/*################## - Удаляем все файлы из /img/blog/tmp/ - ########################*/
$basePath = ROOT .'/img/blog/';
$flist = glob($basePath.'tmp/*.*');
	if (count($flist))
	{
		foreach ($flist as $img) {
			//echo $img.'<br/>';
			if (file_exists($img) && is_file($img)) unlink ($img);
		}
	}
/*##################################################################################*/

//$tb=TAB_TEXT; /*Ниименование таблици в БД*/
/*$res=mysql_query("SELECT * FROM $tb WHERE subsection_id='$subsection_id' LIMIT 1 ;");
if($res)
{
	$row=mysql_fetch_array($res);
	$link=$row['link'];
}*/

//$tb=TAB_IMG; /*Ниименование таблици в БД*/
/*mysql_query("INSERT INTO $tb (topsection_id,section_id,gallery,subsection_id,link) VALUES ('$topsection_id','$section_id','$gallery','$subsection_id','$link')");
$id=mysql_insert_id();*/


$path_parts = pathinfo($fname);
//echo $path_parts['dirname'], "\n";
//echo $path_parts['basename'], "\n".'<br/>';
$ext = $path_parts['extension'];
$file = basename($path_parts['basename'], '.'.$ext);
//echo $ext;
	
	//include ROOT .'/includes/salt.php';
	//$newname=generateSalt();
	$newname=str_replace('.', '_', $file);//убираем точки из названия

	$ftmp=$basePath.'tmp/tmp.'.$ext;
	
move_uploaded_file ( $tname, $ftmp );

function imageresize($outfile,$infile,$neww,$newh,$quality) {
	
	$size = getimagesize ($infile);
	if ($size[2]==1)/*GIF*/
	{
		$im = @imagecreatefromgif ($infile); /* попытка открыть */
	}
	else if ($size[2]==2)/*JPG*/
	{
		$im = @imagecreatefromjpeg ($infile); /* попытка открыть */
	}
	else if ($size[2]==3)/*PNG*/
	{
		$im = @imagecreatefrompng ($infile); /* попытка открыть */
	}
	else if ($size[2]==6)/*BMP*/
	{
		$im = @imagecreatefromwbmp ($infile); /* попытка открыть */
	}
    //$im=imagecreatefromjpeg($infile);
	//$im=$infile;
    $k1=$neww/imagesx($im);
    $k2=$newh/imagesy($im);
    $k=$k1>$k2?$k2:$k1;

    $w=intval(imagesx($im)*$k);
    $h=intval(imagesy($im)*$k);

    $im1=imagecreatetruecolor($w,$h);
    imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

    imagejpeg($im1,$outfile,$quality);
    imagedestroy($im);
    imagedestroy($im1);
    }
//if ($gallery==1)
//{
	imageresize($basePath.'tmp/'.$newname.'_200.jpg',$ftmp,200,200,75);
	imageresize($basePath.'tmp/'.$newname.'_100.jpg',$ftmp,100,100,75);
	//imageresize($basePath.$preview.$finam,$ftmp,125,80,75);
	imageresize($basePath.'tmp/'.$newname.'_50.jpg',$ftmp,50,50,75);
	
	if (file_exists($ftmp)) unlink ($ftmp); //Удаляем оригинал
	
/*}
else if ($gallery==2)
{
	imageresize(ROOT .'/img/projects/g2/'.$id.'.jpg',$ftmp,80,80,75);
}*/
//move_uploaded_file ( $tname, ROOT .'/img/projects/'.$id.'.'.$ext );
	
	
if ($id!='') {
	// Сохраняем изображение
	
		$basePath = ROOT .'/img/blog/';
		$flist = glob($basePath.'tmp/*.jpg');
	if (count($flist)==3)
	{
		foreach ($flist as $img) {
			$rest = substr($img, -7);
			
			if ($rest=='_50.jpg') copy($img, $basePath.$id.'_50.jpg');
			if ($rest=='100.jpg') copy($img, $basePath.$id.'_100.jpg');
			if ($rest=='200.jpg') copy($img, $basePath.$id.'_200.jpg');
			
			if (file_exists($img) && is_file($img)) unlink ($img);
		}
	}
}


report('Картинка загружена !',REFERER,'green');
}
else report('Загружать можно только картинки (gif,jpeg,png,bmp) !!!' ,REFERER,'red');
}
?>
