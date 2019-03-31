<?php

$post = $_POST;

//defined( 'PROTECT' ) or die( include 'access.html' );
//$_SERVER['HTTP_REFERER']

if (count($post) == 0)
{
    die(include 'access.html');
}

ob_start("ob_gzhandler");
//ob_start();

$c1  = strtolower($post['c1']);
$c2  = strtolower($post['c2']);
$c3  = strtolower($post['c3']);
$c4  = strtolower($post['c4']);
$c5  = strtolower($post['c5']);
$c6  = strtolower($post['c6']);
$c7  = strtolower($post['c7']);
$c8  = strtolower($post['c8']);
$c9  = strtolower($post['c9']);
$c10 = strtolower($post['c10']);
$c11 = strtolower($post['c11']);
$c12 = strtolower($post['c12']);


$s1 = $post['s1'];
$s2 = $post['s2'];
if ($s2 < 200)
{
    $s2 = 200;
}
else if ($s2 > 700)
{
    $s2 = 700;
}
$s3 = $post['s3'];
$s4 = $post['s4'];
$s5 = $post['s5'];
$s6 = $post['s6'];
$s7 = $post['s7'];
$s8 = $post['s8'];
/*
  $pn0=iconv("utf-8","windows-1251", $post['n0']);
  $pn1=iconv("utf-8","windows-1251", $post['n1']);
  $pn2=iconv("utf-8","windows-1251", $post['n2']);
  $pn3=iconv("utf-8","windows-1251", $post['n3']);
  $pn4=iconv("utf-8","windows-1251", $post['n4']);
  $pn5=iconv("utf-8","windows-1251", $post['n5']);
  $pn6=iconv("utf-8","windows-1251", $post['n6']);
  $pn7=iconv("utf-8","windows-1251", $post['n7']);
  $pn8=iconv("utf-8","windows-1251", $post['n8']);
  $pn9=iconv("utf-8","windows-1251", $post['n9']);
  $pn10=iconv("utf-8","windows-1251", $post['n10']);
  $pn11=iconv("utf-8","windows-1251", $post['n11']);
  $pn12=iconv("utf-8","windows-1251", $post['n12']);
  $pn13=iconv("utf-8","windows-1251", $post['n13']);
 */

$pn0  = $post['n0'];
//echo '$pn0='.$pn0.'##########';
$pn1  = $post['n1'];
$pn2  = $post['n2'];
$pn3  = $post['n3'];
$pn4  = $post['n4'];
$pn5  = $post['n5'];
$pn6  = $post['n6'];
$pn7  = $post['n7'];
$pn8  = $post['n8'];
$pn9  = $post['n9'];
$pn10 = $post['n10'];
$pn11 = $post['n11'];
$pn12 = $post['n12'];
$pn13 = $post['n13'];

$cap = $post['cap'];
$sf  = $post['sf'];

//$char=$post['char'];
/* $subj=iconv("utf-8","windows-1251", $post['subj']); */
$subj = $post['subj'];
$colo = strtolower($post['colo']);

if ($pn10 != '')
{
    $enctype = 'enctype="multipart/form-data" ';
}
else
{
    $enctype = '';
}
//<input type="hidden" name="charset" value="'.$char.'"/>
//$codf='<form IDFORMM action="http://formm.ru/mail/" '.$enctype.'method="post" onsubmit="return verif();">
$codf = '<form action="https://formm.ru/mail/" ' . $enctype . 'method="post" onsubmit="return formm.sub(this);">

<style>
        .f--all {
            width:98%;
            background: ' . $c7 . ';
            color: ' . $c8 . ';
            border: 1px solid ' . $c9 . ';
            font: ' . $s6 . 'px sans-serif;
            padding: 0 1%;
        }
        .f--input {
            height: ' . $s3 . 'px;
        }
        .f--text {
            height: ' . $s4 . 'px;
        }
        .f--file {
            width: ' . ($s2 - 32) . 'px;
            height: ' . $s3 . 'px;
            font: 13px sans-serif;
            cursor:pointer;
            padding: 0;
        }
        .f--button {
        width:' . $s7 . 'px;
        height:' . $s8 . 'px;
        background:' . $c10 . ';
        color:' . $c11 . ';
        border-color:' . $c12 . ';
        font:' . ($s5 + 2) . 'px sans-serif;
        cursor:pointer;
        }
    </style>

<input type="hidden" name="check" value="name:Ваше имя?!.email:Укажите правильный e-mail!.text:Напишите сообщение!.captcha:Ошибка в проверочном коде!"/>
<input type="hidden" name="subject" value="' . $subj . '"/>
<input type="hidden" name="colors" value="' . $colo . '"/>

<div id="forma" style="margin-left:50%;position:relative; left:-' . ($s2 / 2) . 'px; width:' . $s2 . 'px;background:' . $c4 . ';color:' . $c5 . ';border:1px solid ' . $c6 . ';font:' . $s5 . 'px sans-serif;">

<div id="ftitle" style="padding:' . $s1 . 'px;background:' . $c1 . ';color:' . $c2 . ';border:1px solid ' . $c3 . ';text-align:center;"><strong>' . $pn0 . '</strong></div>

<div id="forma2" style="padding:0 15px 10px 15px;border-top:solid 1px ' . $c6 . ';">

<div id="tname" style="margin-top:10px;">' . $pn1 . '</div>
<input id="name" name="name" type="text" class="f--all f--input" maxlength="50" />

<div id="temail" style="margin-top:10px;">' . $pn2 . '</div>
<input id="email" name="email" type="text" class="f--all f--input" maxlength="50" />';

if ($pn3 != '')
{
    $codf .= '<div id="bdp3" style="margin-top:10px;">
<div id="tdp3">' . $pn3 . '</div>
<input id="dp3" name="dp3" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
if ($pn4 != '')
{
    $codf .= '<div id="bdp4" style="margin-top:10px;">
<div id="tdp4">' . $pn4 . '</div>
<input id="dp4" name="dp4" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
if ($pn5 != '')
{
    $codf .= '<div id="bdp5" style="margin-top:10px;">
<div id="tdp5">' . $pn5 . '</div>
<input id="dp5" name="dp5" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
if ($pn6 != '')
{
    $codf .= '<div id="bdp6" style="margin-top:10px;">
<div id="tdp6">' . $pn6 . '</div>
<input id="dp6" name="dp6" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
if ($pn7 != '')
{
    $codf .= '<div id="bdp7" style="margin-top:10px;">
<div id="tdp7">' . $pn7 . '</div>
<input id="dp7" name="dp7" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
if ($pn8 != '')
{
    $codf .= '<div id="bdp8" style="margin-top:10px;">
<div id="tdp8">' . $pn8 . '</div>
<input id="dp8" name="dp8" type="text" class="f--all f--input" maxlength="50" />
</div>';
}
$codf .= '<div id="ttext"style="margin-top:10px;">' . $pn9 . '</div>
<textarea id="text" name="text" class="f--all f--text" rows="5" cols="20"></textarea>';
if ($pn10 != '')
{
    $codf .= '<div id="bfile" style="margin-top:10px;">
<div id="tfile">' . $pn10 . '</div>
<input id="file" name="file" type="file" multiple="multiple" size="' . $sf . '" class="f--all f--file" />
</div>';
}
if ($cap == 1)
{
    $codf .= '<div id="fcap1" style="width:100%;min-height:50px;margin-top:10px;">
<a style="display:bloc;width:100px;text-align:center;float:left;" href="https://formm.ru/">форма обратной связи</a>
<img style="border:none;cursor:pointer;margin:9px;float:left;" src="https://formm.ru/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>
<div style="margin-left:160px;">
<div id="tcap1">' . $pn11 . '</div>
<input id="cap1" name="captcha" type="text" class="f--all f--input" maxlength="6" />
</div>
<div style="width:100%;height:10px;float:left;"></div>
</div>';
}
else if ($cap == 2)
{
    $codf .= '<div id="fcap2" style="width:100%;min-height:50px;margin-top:10px;">
<a style="display:bloc;width:100px;text-align:center;float:right;" href="https://formm.ru/">форма обратной связи</a>
<img style="border:none;cursor:pointer;margin:9px;float:right;" src="https://formm.ru/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>
<div style="margin-right:160px;">
<div id="tcap2">' . $pn11 . '</div>
<input id="cap2" name="captcha" type="text" class="f--all f--input" maxlength="6" />
</div>
<div style="width:100%;height:10px;float:left;"></div>
</div>';
}
/*
  if ($cap==1) $codf.='<div id="fcap1" style="width:100%;margin-top:10px;overflow:auto;">
  <a style="float:left;" href="http://www.formm.ru/"><img border="0" src="http://www.formm.ru/captcha/" alt="captcha"/></a>
  <div style="margin-left:110px;">
  <div id="tcap1">'.$pn11.'</div>
  <input id="cap1" name="captcha" type="text" style="margin-left:-2px;width:100%;height:'.$s3.'px; background:'.$c7.';color:'.$c8.';border:1px solid '.$c9.';font:'.$s6.'px sans-serif;" maxlength="6" />
  </div>
  </div>';
  else if ($cap==2) $codf.='<div id="fcap2" style="width:100%;margin-top:10px;overflow:auto;">
  <a style="float:right;" href="http://www.formm.ru/"><img border="0" src="http://www.formm.ru/captcha/" alt="captcha"/></a>
  <div style="margin-right:110px;">
  <div id="tcap2">'.$pn11.'</div>
  <input id="cap2" name="captcha" type="text" style="width:100%;height:'.$s3.'px; background:'.$c7.';color:'.$c8.';border:1px solid '.$c9.';font:'.$s6.'px sans-serif;" maxlength="6" />
  </div>
  </div>';
 */
/*
  if ($cap==1) $codf.='<table id="fcap1" border="0" style="width:100%;margin-top:10px;table-layout:fixed;border-collapse:collapse;">
  <tr>
  <td style="width:100px;text-align:center;"><a href="http://www.formm.ru/">форма обратной связи</a></td>
  <td style="width:60px;text-align:center;"><img border="0" style="cursor:pointer;width:50px; height:50px;" src="http://www.formm.ru/refresh/008.gif" alt="refresh" title="refresh" onclick="formm.cap();"/></td>
  <td><div id="tcap1">'.$pn11.'</div><input id="cap2" name="captcha" type="text" style="width:100%;height:'.$s3.'px; background:'.$c7.';color:'.$c8.';border:1px solid '.$c9.';font:'.$s6.'px sans-serif;" maxlength="6"/></td>
  </tr>
  </table>';
  else if ($cap==2) $codf.='<table id="fcap2" border="0" style="width:100%;margin-top:10px;table-layout:fixed;border-collapse:collapse;">
  <tr>
  <td><div id="tcap2">'.$pn11.'</div><input id="cap2" name="captcha" type="text" style="width:100%;height:'.$s3.'px; background:'.$c7.';color:'.$c8.';border:1px solid '.$c9.';font:'.$s6.'px sans-serif;" maxlength="6"/></td>
  <td style="width:60px;text-align:center;"><img border="0" style="cursor:pointer;width:50px; height:50px;" src="http://www.formm.ru/refresh/008.gif" alt="refresh" title="refresh" onclick="formm.cap();"/></td>
  <td style="width:100px;text-align:center;"><a href="http://www.formm.ru/">форма обратной связи</a></td>
  </tr>
  </table>';
 */

$codf .= '<div style="margin-top:10px; text-align:center;">
<input type="submit" value="' . $pn12 . '" class="f--button" />';
//'<input id="but12" type="button" value="'.$pn12.'" style="width:'.$s7.'px;height:'.$s8.'px;background:'.$c10.';color:'.$c11.';border-color:'.$c12.';font:'.($s5+2).'px sans-serif; cursor:pointer;" />';
if ($pn13 != '')
{
    $codf .= '<input id="but13" type="reset" value="' . $pn13 . '" class="f--button" />';
}
$codf .= '
</div>
</div>
</div>
<script type="text/javascript" src="https://formm.ru/mail/js/s.f.p.js"></script>
</form>
';

$xxxxxx = '
<script type="text/javascript">/*<![CDATA[*/
function verif() {
var f = {};
var fm=document.forms["formm"].elements;
for(var i=0; i<fm.length; i++) {
var n=fm[i].name;
var v=fm[i].value;
if (n!="subject" && n!="colors" && n!="file" && v=="") {
alert ("Заполните все поля формы");
return false; 
} else f[n]=v;
}
if(!f.email.match(/^[a-z\d]+((\.|\-|\_)?[a-z\d]+)*@[a-z\d]+((\.|\-)?[a-z\d]+)*\.[a-z]{2,4}$/i)) {
alert ("Укажите правильный e-mail");
return false;
} else if (!f.captcha.match(/^[a-z\d]{5,6}$/i)) {
alert ("Ошибка в проверочном коде");
return false;
} else return true;
}
/*]]>*/</script>';
//!!!!!!!!!!!! $codf.=ob_get_contents(); ob_end_flush();
$codf   = preg_replace('/id=("|\').*("|\')/Uis', '', $codf);
//!!!!!!!!!!!! $codf= preg_replace('/\s+/Uis', ' ', $codf);
//$codf= preg_replace('/(\s|\t)+/Uis', ' ', $codf);

$codf = preg_replace('/\s*("|\'|<|>|;)\s*/Uis', '$1', $codf);

//$codf= str_replace('IDFORMM', 'id="formm"', $codf);
//$codf= preg_replace('/(\r\n|\n)+/Uis', "\n", $codf);
//echo $codf;
//echo '<pre><code>'."\r\n".htmlspecialchars($codf)."\r\n".'</code></pre>'."\r\n";
echo htmlspecialchars($codf);
//echo htmlspecialchars ($codf.=ob_get_contents(););
//ob_clean();
//ob_end_clean();