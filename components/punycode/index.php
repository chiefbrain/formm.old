<?php
defined("PROTECT") or die("Restricted access");

$app['title']    = 'PUNYCODE КОНВЕРТЕР';
$app['keywords'] = 'punycode конвертер,';

$encoded = $decoded = $add     = '';

$IDN = new \App\Add\IdnaConvert();

if (isset($_REQUEST['encode']))
{
    $decoded = isset($_REQUEST['decoded']) ? stripslashes($_REQUEST['decoded']) : '';
    $encoded = $IDN->encode($decoded);
}
if (isset($_REQUEST['decode']))
{
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
                <input style="width:98%;" type="text" name="decoded" value="<?= $decoded; ?>" maxlength="255" />
            </td>
            <td>
                <input style="width:150px;" type="submit" name="encode" value="Кодировать &gt;&gt;" />
                <br/>
                <input style="width:150px;" type="submit" name="reset" value="Очистить" />
                <br/>
                <input style="width:150px;" type="submit" name="decode" value="&lt;&lt; Декодировать" />
            </td>
            <td>
                <input style="width:98%;" type="text" name="encoded" value="<?= $encoded; ?>" maxlength="255" />
            </td>
        </tr>

    </table>
</form>
<add-punycode/>

