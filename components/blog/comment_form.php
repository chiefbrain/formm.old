<?php

defined('PROTECT') or die('Restricted access');

// комментарии:
?>


<form class="bx" style="width:100%;float:left;" name="comm" action="" onsubmit="return subcom();" method="post">
    <input type="hidden" name="action" value="comment"/>
    <input type="hidden" name="id" value="<?= $id; ?>"/>

    <div style="text-align:center;padding:5px;"><strong>Оставьте свой комментарий:</strong>	</div>

    <table style="width:100%;/*margin-left: 50%;position: relative;left: -350px;*/ table-layout:fixed;" >
    <!--<col width="110" valign="top" />-->

        <tr>
            <td style="width:110px;">Представьтесь:</td>
            <td colspan="2"><input style="width:99%" name="name" maxlength="50" type="text"/></td>
        </tr>
        <tr>
            <td>Ваш e-mail:</td>
            <td colspan="2"><input style="width:99%" name="email" maxlength="50" type="text"/></td>
        </tr>
        <tr>
            <td>Ваш комментарий:</td>
            <td colspan="2"><textarea style="width:99%;" name="comment" rows="3" cols="20"></textarea></td>
        </tr>
        <tr>
            <td><img style="cursor:pointer;" src="/captcha/" alt="captcha" border="0" onclick="this.src = '/captcha/?v=' + c++;" /></td>
            <td>Проверочный код:<br/><input style="width:99%" name="captcha" maxlength="6" type="text"/></td>
            <td style="text-align:center;"><input type="submit" value="Отправить" style="width:155px;height:30px;cursor:pointer;" /></td>
        </tr>
    </table>

<!--<table style="width:100%;/*margin-left: 50%;position: relative;left: -350px;*/ table-layout:fixed;" class="bx">
<col width="110" valign="top" />
        <tr>
                <th colspan="3"><strong>Оставьте свой комментарий:</strong></th>
        </tr>
        <tr>
                <td>Представьтесь:</td>
                <td colspan="2"><input style="width:99%" name="name" maxlength="50" type="text"/></td>
        </tr>
        <tr>
                <td>Ваш e-mail:</td>
                <td colspan="2"><input style="width:99%" name="email" maxlength="50" type="text"/></td>
        </tr>
        <tr>
                <td>Ваш комментарий:</td>
                <td colspan="2"><textarea style="width:99%;" name="comment" rows="3" cols="20"></textarea></td>
        </tr>
        <tr>
                <td><img style="cursor:pointer;" src="/captcha/" alt="captcha" border="0" onclick="this.src='/captcha/?v='+c++;" /></td>
                <td>Проверочный код:<br/><input style="width:99%" name="captcha" maxlength="6" type="text"/></td>
                <td style="text-align:center;"><input type="submit" value="Отправить" style="width:155px;height:30px;cursor:pointer;" /></td>
        </tr>
</table>-->
</form>
<script type="text/javascript">//<![CDATA[
    var c = 0;
    function subcom() {
        var f = document.forms.comm;
        if (f.name.value == '') {
            alert('Представьтесь.');
            return false;
        } else if (f.comment.value == '') {
            alert('Оставьте свой комментарий.');
            return false;
        } else if (f.captcha.value == '') {
            alert('Введите проверочный код.');
            return false;
        }
        return true;
    }
//]]></script>