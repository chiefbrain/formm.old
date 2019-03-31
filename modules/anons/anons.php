<?php defined( 'PROTECT' ) or die( 'Restricted access' ); 

$tb = $app['TAB_BLOG'];

//$res=mysql_query("SELECT id,title,link FROM $tb ORDER BY id DESC LIMIT 10");

$res = $app['db']->select($tb,['id','title','link'], ['ORDER' => ['id' => 'DESC'], 'LIMIT' => 10]);

$app['debug']->db();

$list = '';
if(!empty($res))
{
	$list = '<div class="anons" style="text-align:center;"><a href="/blog/">Блог:</a></div>';
	//while($row=mysql_fetch_array($res))
        foreach ($res as $row)
	{
		$id = $row['id'];
		
		if (file_exists($app['root'] .'/img/blog/'.$id.'_50.jpg')) //$img = '<img src="/img/blog/'.$id.'_100.jpg" style="margin:5px;float:left;" alt=""/>';
		$img = '<div class="img50" style="background:url(/img/blog/'.$id.'_50.jpg) center center no-repeat;"></div>';
		else $img='';
		$list .= '<div class="anons">';
		$list .= $img;
		$list .= '<div  style="margin-left:70px;text-align:center;">';
		$list .= '<a href="/blog-'.$row['link'].'.html">'.$row['title'].'</a></div></div>';//<br/>';
		//$list .= $row['anons'].'</div></div>';
	}
}
?>

<a href="http://adminex.ru/" style="display:block;padding-top:80px;height:20px;background:url(/img/adminex.gif) center center no-repeat; margin-bottom: 20px;font-size:8px;text-decoration:none;color:#f80;text-align:center;">Поддержка сайта</a>

<?php

echo $list;


