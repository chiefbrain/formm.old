<?php defined('PROTECT') or die(include 'access.html'); ?>

<table id="pmenu" style="cursor:pointer;width:100%;table-layout:fixed;text-align:center;">
    <tr>
        <td id="rmcolor" style="border:1px solid #ccc;">Цвета</td>
        <td id="rmsize" style="border:1px solid #ccc;">Размеры</td>
        <td id="rmtext" style="border:1px solid #ccc;">Надписи</td>
    </tr>
    <tr>
        <td id="rmset" style="border:1px solid #ccc;">Настройки</td>
        <!--<td id="rm1" style="border:1px solid #ccc;"></td>
        <td id="rm2" style="border:1px solid #ccc;"></td>-->
    </tr>
</table>
<!--########################################################-->
<div id="blcolor" style="display:block;">
    <div style="border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Цвета заголовка формы</div>
        <ul class="mul">
            <li>
                <input class="inpc" id="ftit" type="text" readonly="readonly" size="7" />&nbsp;цвет фона заголовка
            </li>
            <li>
                <input class="inpc" id="ctit" type="text"  readonly="readonly" size="7" />&nbsp;цвет текста заголовка
            </li>
            <li>
                <input class="inpc" id="btit" type="text" readonly="readonly" size="7" />&nbsp;цвет рамки заголовка
            </li>
        </ul>
    </div>
    <!--########################################################-->
    <div style="border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Цвета формы</div>
        <ul class="mul">
            <li>
                <input class="inpc" id="cform" type="text" readonly="readonly" size="7" />&nbsp;цвет фона формы
            </li>
            <li>
                <input class="inpc" id="tform" type="text" readonly="readonly" size="7" />&nbsp;цвет текста формы
            </li>
            <li>
                <input class="inpc" id="bform" type="text" readonly="readonly" size="7" />&nbsp;цвет рамки формы
            </li>
        </ul>
    </div>
    <!--########################################################-->
    <div style="border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Цвета полей данных</div>
        <ul class="mul">
            <li>
                <input class="inpc" id="fname" type="text" readonly="readonly" size="7" />&nbsp;цвет фона
            </li>
            <li>
                <input class="inpc" id="cname" type="text" readonly="readonly" size="7" />&nbsp;цвет текста
            </li>
            <li>
                <input class="inpc" id="bname" type="text" readonly="readonly" size="7" />&nbsp;цвет рамки
            </li>
        </ul>
    </div>
    <!--########################################################-->
    <div style="border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Цвета кнопки</div>
        <ul class="mul">
            <li>
                <input class="inpc" id="fbut" type="text" readonly="readonly" size="7" />&nbsp;цвет фона
            </li>
            <li>
                <input class="inpc" id="cbut" type="text" readonly="readonly" size="7" />&nbsp;цвет текста
            </li>
            <li>
                <input class="inpc" id="bbut" type="text" readonly="readonly" size="7" />&nbsp;цвет рамки
            </li>
        </ul>
    </div>
</div>
<!--########################################################-->
<div id="blsize" style="display:none; border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Размеры</div>
    <ul class="mul">
        <li>
            <input id="ht" type="text" name="ht" size="7" maxlength="2" />
            &nbsp;<label for="ht">Высота заголовка px</label>
        </li>
        <li>
            <input id="wf" type="text" name="wf" size="7" maxlength="3" />
            &nbsp;<label for="wf">ширина формы px</label><br />
        </li>
        <li>
            <input id="hp" type="text" name="hp" size="7" maxlength="2" />
            &nbsp;<label for="hp">Высота полей данных px</label>
        </li>
        <li>
            <input id="htx" type="text" name="htx" size="7" maxlength="3" />
            &nbsp;<label for="htx">Поле сообщения px</label>
        </li>
        <li>
            <input id="hsf" type="text" name="hsf" size="7" maxlength="2" />
            &nbsp;<label for="hsf">Размер шрифта формы px</label>
        </li>
        <li>
            <input id="hsp" type="text" name="hsp" size="7" maxlength="2" />
            &nbsp;<label for="hsp">Шрифт полей ввода px</label>
        </li>
        <li>
            <input id="h12" type="text" name="h12" size="7" maxlength="3" />
            &nbsp;<label for="h12">Ширина кнопки px</label>
        </li>
        <li>
            <input id="h13" type="text" name="h13" size="7" maxlength="2" />
            &nbsp;<label for="h13">Высота кнопки px</label>
        </li>
    </ul>
</div>
<!--########################################################-->
<div id="bltext" style="display:none; border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Надписи</div>

    <ul class="mul">
        <li>
            <input id="cp0" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Заголовок
            <input id="p0" type="text" style="width:100%" value="ОБРАТНАЯ СВЯЗЬ"/>
        </li>
        <li>
            <input id="cp1" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Поле ввода имени
            <input id="p1" type="text" style="width:100%" value="Ваше имя"/>
        </li>
        <li>
            <input id="cp2" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Поле ввода e-Mail
            <input id="p2" type="text" style="width:100%" value="Обратный e-mail"/>
        </li>
        <li>
            <input id="cp3" type="checkbox"/>&nbsp;Дополнительное поле 1
            <input id="p3" type="text" style="width:100%" value="Поле ввода 1"/>
        </li>
        <li>
            <input id="cp4" type="checkbox"/>&nbsp;Дополнительное поле 2
            <input id="p4" type="text" style="width:100%" value="Поле ввода 2"/>
        </li>
        <li>
            <input id="cp5" type="checkbox"/>&nbsp;Дополнительное поле 3
            <input id="p5" type="text" style="width:100%" value="Поле ввода 3"/>
        </li>
        <li>
            <input id="cp6" type="checkbox"/>&nbsp;Дополнительное поле 4
            <input id="p6" type="text" style="width:100%" value="Поле ввода 4"/>
        </li>
        <li>
            <input id="cp7" type="checkbox"/>&nbsp;Дополнительное поле 5
            <input id="p7" type="text" style="width:100%" value="Поле ввода 5"/>
        </li>
        <li>
            <input id="cp8" type="checkbox"/>&nbsp;Дополнительное поле 6
            <input id="p8" type="text" style="width:100%" value="Поле ввода 6"/>
        </li>
        <li>
            <input id="cp9" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Поле ввода сообщения
            <input id="p9" type="text" style="width:100%" value="Сообщение"/>
        </li>
        <li>
            <input id="cp10" type="checkbox"/>&nbsp;Поле отправки файла, max: 9 mb
            <input id="p10" type="text" style="width:100%" value="Прикрепить файл"/>
        </li>
        <li>
            <input id="cp11" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Поле ввода проверочного кода<br/>
            <input id="r1" name="rcap" type="radio" checked="checked" value="1" />вариант-1&nbsp;
            <input id="r2" name="rcap" type="radio" value="2"/>вариант-2
            <input id="p11" type="text" style="width:100%" value="Проверочный код"/>
        </li>
        <li>
            <input id="cp12" type="checkbox" checked="checked" disabled="disabled"/>&nbsp;Кнопка отправить
            <input id="p12" type="text" style="width:100%" value="Отправить"/>
        </li>
        <li>
            <input id="cp13"  type="checkbox"/>&nbsp;Кнопка очистить
            <input id="p13" type="text" style="width:100%" value="Очистить"/>
        </li>
    </ul>

</div>
<!--########################################################-->
<div id="blset" style="display:none; border:1px solid #ccc;margin-bottom:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Дополнительные настройки</div>
    <!--
    <div style="margin-top:10px;">Кодировка Вашего сайта</div>
    <select id="sel" name="charset" style="width:100%">
            <option disabled="disabled">Выберите кодировку</option>
            <option selected="selected" value="windows-1251">windows-1251</option>
            <option  value="utf-8">utf-8</option>
    </select>
    -->
    <div style="margin-top:10px;">Тема приходящего сообщения</div>
    <input id="sub" type="text" style="width:100%" value="Сообщение с сайта"/>

    <div style="border:1px solid #ccc;margin-top:10px;padding:5px;"><div style="text-align:center;margin-bottom:10px;">Цвета страницы сообщения</div>
        <input id="rr1" name="rr" type="radio" checked="checked" value="0" />
        цвета формы
        <input id="rr2" name="rr" type="radio" value="1"/>
        другие цвета

        <ul class="mul">
            <li>
                <input class="inpc" id="fmfon" type="text" readonly="readonly" size="7" />&nbsp;цвет фона страницы
            </li>
        </ul>

        <ul id="colorm" class="mul" style="display:none;">
            <li>
                <input class="inpc" id="fmwin" type="text" readonly="readonly" size="7" />&nbsp;цвет фона окна
            </li>
            <li>
                <input class="inpc" id="cmwin" type="text"  readonly="readonly" size="7" />&nbsp;цвет текста окна
            </li>
            <li>
                <input class="inpc" id="bmwin" type="text" readonly="readonly" size="7" />&nbsp;цвет рамки окна
            </li>
        </ul>

    </div>
</div>
<!--########################################################-->
<input class="button" type="button" value="Получить код" style="cursor:pointer; width:100%; font:15px sans-serif;" onclick="CreateCod();" />
