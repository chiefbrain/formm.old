<form id="fform" action="" enctype="multipart/form-data" method="post">

    <input type="hidden" name="check" value="name:Ваше имя?.email:Укажите правильный e-mail.text:Напишите сообщение!.captcha:Ошибка в проверочном коде"/>

    <div style="text-align:center;">Так будет выглядеть Ваша форма обратной связи.<br/>Можете изменить цвета, размеры и надписи, панель слева.<br/>Чтобы получить код формы обратной связи нажмите кнопку слева внизу "получить код".<br/>Не забудьте <a href="/regs/">зарегистрировать</a> форму, иначе она не будет работать.<br/><br/></div>

    <div id="forma" style="margin-left:50%;position:relative; left:-200px; width:400px;background:#ffe;color:#800;border:1px solid #800;font:12px sans-serif;">

        <div id="ftitle" style="padding:2px;background:#800;color:#ff6;border:1px solid #800;text-align:center;"><strong>ОБРАТНАЯ СВЯЗЬ</strong></div>

        <div id="forma2" style="padding:0 15px 10px 15px;border-top:solid 1px #800;">

            <div id="tname" style="margin-top:10px;">Ваше имя</div>
            <input id="name" name="name" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />

            <div id="temail" style="margin-top:10px;">Обратный e-mail</div>
            <input id="email" name="email" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />

            <div id="bdp3" style="display:none;margin-top:10px;">
                <div id="tdp3">Дополнительное поле 1</div>
                <input id="dp3" name="dp3" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>
            <div id="bdp4" style="display:none;margin-top:10px;">
                <div id="tdp4">Дополнительное поле 2</div>
                <input id="dp4" name="dp4" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>
            <div id="bdp5" style="display:none;margin-top:10px;">
                <div id="tdp5">Дополнительное поле 3</div>
                <input id="dp5" name="dp5" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>
            <div id="bdp6" style="display:none;margin-top:10px;">
                <div id="tdp6">Дополнительное поле 4</div>
                <input id="dp6" name="dp6" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>
            <div id="bdp7" style="display:none;margin-top:10px;">
                <div id="tdp7">Дополнительное поле 5</div>
                <input id="dp7" name="dp7" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>
            <div id="bdp8" style="display:none;margin-top:10px;">
                <div id="tdp8">Дополнительное поле 6</div>
                <input id="dp8" name="dp8" type="text" style="margin-left:-1px;width:98%;padding:0 1%;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" maxlength="50" />
            </div>

            <div id="ttext" style="margin-top:10px;">Сообщение</div>
            <textarea id="text" name="text" style="margin-left:-1px;width:98%;padding:0 1%;height:100px; background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;" rows="5" cols="20"></textarea>

            <div id="bfile" style="display:none;margin-top:10px;">
                <div id="tfile">Прикрепить файл</div>
                <input id="file" name="file" type="file" size="30" style="width:368px;height:20px;background:#fff;color:#800;border:1px solid #800;font:13px sans-serif;cursor:pointer;" />
            </div>

            <div id="fcap1" style="width:98%;padding:0 1%;min-height:50px;margin-top:10px;"><!--overflow:auto;">-->
                <img border="0" style="float:left" src="/captcha/" alt="formm.captcha" title="captcha"/>
                <img border="0" style="cursor:pointer;margin:9px;float:left;" src="https://formm.ru/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>
                <div style="margin-left:150px;">
                    <div id="tcap1">Проверочный код</div>
                    <input id="cap1" name="captcha" type="text" style="margin-left:-2px;width:98%;padding:0 1%;height:20px; background:#fff; border:1px solid #800; color:#800;font:13px sans-serif;" maxlength="6" />
                </div>
                <div style="width:100%;height:10px;float:left;clear:both;"></div>
            </div>

            <div id="fcap2" style="display:none;width:100%;min-height:50px;margin-top:10px;"><!--overflow:auto;">-->
                <img border="0" style="float:right" src="/captcha/" alt="formm.captcha" title="captcha"/>
                <img border="0" style="cursor:pointer;margin:9px;float:right;" src="https://formm.ru/refresh/refresh.png" alt="formm.refresh" title="refresh" onclick="formm.cap();"/>
                <div style="margin-right:150px;">
                    <div id="tcap2">Проверочный код</div>
                    <input id="cap2" name="captcha" type="text" style="width:100%;height:20px; background:#fff; border:1px solid #800; color:#800;font:13px sans-serif;" maxlength="6" />
                </div>
                <div style="width:100%;height:10px;float:left;"></div>
            </div>

            <div style="margin-top:10px; text-align:center;">
            <!--<input type="submit" value="Отправить" style="cursor:pointer; width:250px; font:15px sans-serif;" />-->
                <input id="but12" type="button" value="Отправить" style="width:150px;height:35px;background:#800;color:#ff6; border-color:#ffc;font:15px sans-serif; cursor:pointer;" />

                <input id="but13" type="reset" value="Очистить" style="width:150px;height:35px;background:#800;color:#ff6; border-color:#ffc;font:15px sans-serif; cursor:pointer;display:none;" />
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="https://www.formm.ru/mail/js/formm.p.js<?= $comb ?>"></script>
<!--########################################################-->

<div id="mfon0" style="width:100%; background:#fff;padding:150px 5px;display:none;">

    <div style="text-align:center;">Так будет выглядеть ответ сервера после отправки сообщения.<br/>Можете изменить цвета сообщения, панель слева.<br/>Чтобы получить код формы обратной связи нажмите кнопку слева в низу "получить код".<br/><br/><br/></div>

    <div id="mwin0" style="margin-left:50%;position:relative; left:-150px; width:300px;background:#ffe;color:#800;border:1px solid #800;font:12px sans-serif;">
        <div id="mtit0" style="background:#800;border:1px solid #ffe;">&nbsp;</div>
        <div id="mmes0" style="border-top:1px solid #800;padding:30px 5px;text-align:center;">Сообщение отправлено<br/>(цвета формы)</div>

    </div>
</div>
<!--########################################################-->

<div id="mfon1" style="width:100%; background:#fff;padding:150px 5px;display:none;">

    <div style="text-align:center;">Так будет выглядеть ответ сервера после отправки сообщения.<br/>Можете изменить цвета сообщения, панель слева.<br/>Чтобы получить код формы обратной связи нажмите кнопку слева в низу "получить код".<br/><br/><br/></div>

    <div id="mwin1" style="margin-left:50%;position:relative; left:-150px; width:300px;background:#ffe;color:#800;border:1px solid #800;font:12px sans-serif;">
        <div id="mtit1" style="background:#800;border:1px solid #ffe;">&nbsp;</div>
        <div id="mmes1" style="border-top:1px solid #800;padding:30px 5px;text-align:center;">Сообщение отправлено<br/>(альтернативные цвета)</div>

    </div>
</div>
