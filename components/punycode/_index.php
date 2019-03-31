<?php
defined( "PROTECT" ) or die( "Restricted access" );

$app['title'] = 'PUNYCODE КОНВЕРТЕР';
$GLOBALS['keywords'] = 'punycode конвертер,';

$encoded = $decoded = $add = '';

include(ROOT .'/classes/idna_convert.class.php');
$IDN = new idna_convert();
if (isset($_REQUEST['encode'])) {
    $decoded = isset($_REQUEST['decoded']) ? stripslashes($_REQUEST['decoded']) : '';
    $encoded = $IDN->encode($decoded);
}
if (isset($_REQUEST['decode'])) {
    $encoded = isset($_REQUEST['encoded']) ? stripslashes($_REQUEST['encoded']) : '';
    $decoded = $IDN->decode($encoded);
}

?>

<h3 style="text-align:center;">Online-перекодировщик или <strong>Punycode</strong> - конвертер</h3>
<p style="text-align: justify;">Этот перекодировщик создан для преобразования русских доменных имён в <strong>Punycode</strong> кодировку , которая используется в мультиязычной системе доменов. И обратно из <strong>Punycode</strong> в оригинальное представление.</p>
<br/>

<form action="" method="post">

 <table border="0" cellpadding="2" cellspacing="2" summary="" style="width:100%;table-layout:fixed;">

   <tr>
    <th>Original</th>
    <th  style="width:320px;">&nbsp;</th>
    <th>Punycode</th>
   </tr>

   <tr style="text-align:center;">
    <td>
    <input style="width:98%;" type="text" name="decoded" value="<?php echo $decoded; ?>" maxlength="255" />
    </td>
    <td>
    <input style="width:150px;" type="submit" name="encode" value="Кодировать &gt;&gt;" />
    <br/>
    <input style="width:150px;" type="submit" name="reset" value="Очистить" />
    <br/>
    <input style="width:150px;" type="submit" name="decode" value="&lt;&lt; Декодировать" />
    </td>
    <td>
      <input style="width:98%;" type="text" name="encoded" value="<?php echo $encoded; ?>" maxlength="255" />
    </td>
   </tr>

 </table>
</form>
<br/><br/>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Современный мир богат на разного рода терминологию. А интернет вообще изобилует неведомыми понятиями. Одно из таких: <strong>пуникод</strong>. Данный термин появился в интернет-среде сравнительно недавно. Что ж это за &quot;зверь&quot; такой? На самом деле, все намного проще, чем может показаться на первый взгляд. <strong>Пуникод</strong> преобразовывает национальные алфавитные символы в <strong>Unicode</strong>, согласно разработанному алгоритму.</p>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Долгое время в адресной строке российские жители, да и жители других стран набирали название сайта, используя при этом латинские буквы, цифры и пробел. Естественно, такое положение вещей было не очень удобно для тех, кто пишет с помощью других символов. Например, мы с Вами используем для письма кириллицу, а для жителей Китая, Израиля и Ирана латиница вообще непривычна и чужда. Получалась довольно неприглядная ситуация: Сеть Интернет разрастается с каждой минутой, а доступна она далеко не всем. На этом этапе существования сети Интернет была система доменных имен - DNS, которая была ограничена символами кодировки ASCII (чаще всего обозначают как &laquo;LDH&raquo; или &laquo;код LDH&raquo;).</p>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; В 2003 году, корпорация ICANN приняла решение о регистрации доменных имен в кодировке <strong>Unicode</strong>. Данная кодировка распознает символы алфавитов всех стран мира. Благодаря Unicode появилась отличная возможность создавать доменные имена на родном языке (в нашем случае - <strong>домен .РФ</strong>). С этой целью был разработан специальный стандарт - <strong>IDN-доменов</strong>. Кодировка данных доменных имен не входит в систему символов кодировки ASCII . Тогда и появился стандарт <strong>Punycode</strong>, который конвертирует символы <strong>Unicode </strong>в набор символов кодировки DNS. Создан и специальный <strong>стандарт RFC 3492</strong>, который описывает алгоритм преобразования.</p>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Обычный пользователь не видит всех сложных кодировок и самого процесса преобразования одной кодировки в другую. На самом же деле, &quot;кипит&quot; работа по распознаванию и преобразованию. Так, например, для того, чтобы <strong>IDN-домены</strong> были индивидуальны и их нельзя было бы спутать ни с какими другими, начинаются они с префикса &laquo;XN--&raquo;. Вот, казалось бы, самое простое имя сайта: &quot;САЙТ.COM&quot;. Не составит никаких проблем набрать это имя в адресной строке. После того, как имя набрано, свою работу начинает <strong>Пуникод </strong>и вот, что получается: &laquo;XN--80ASWG.COM&raquo;. Имя &quot;САЙТ&quot; перекодировано в 80ASWG.</p>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Пользователи Рунета первые в мире получили возможность для названия сайтов использовать <strong>IDN-домены</strong>. При этом, преобразователь <strong>Punycode </strong>применяют не только для перекодировки самого доменного имени, но и для зоны (РФ). Для домена РФ характерен такой псевдоним, который прописывается в DNS: &laquo;XN--P1AI&raquo;. В итоге, если рассматривать работу Punycode-преобразователя на примере, то получим: кириллический домен &laquo;МойСайт.РФ&raquo; будет выглядеть в нужной кодировке как &laquo;XN--80ARBJKTJ.XN--P1AI&raquo;.</p>
<p style="text-align: justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Собственно, для того, чтобы были доступны международные домены (<strong>IDN-домены</strong>) достаточно, чтобы <strong>Punycode</strong>-преобразователь поддерживал Интернет браузер. В настоящее время абсолютно все современные версии браузеров обладают такой функцией. Поэтому для пользователя работа <strong>Punycode </strong>останется незамеченной.</p>
<br/>

