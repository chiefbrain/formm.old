<?php
defined('PROTECT') or die('Restricted access');
/**/
?>
<div style="text-align:center;">

    <!--noindex-->
    <?php
    /** Google banner */
    if ($app['banner_google']) {
        ?>

        <script async
                src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- FORMM_1 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-0740916789993191"
             data-ad-slot="6978781598"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <script type="text/javascript" src="/useragent/"></script>

        <?php
    }
    /** Google Analytics */
    if ($app['counter_google']) {
    ?>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-34215060-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
            <?php

            /*
              (function() {
              function async_load(u,id){
              if (!gid(id)) {
              s="script", d=document,
              o = d.createElement(s);
              o.type = 'text/javascript';
              o.async = true;
              o.src = u;
              // Creating scripts on page
              x = d.getElementsByTagName(s)[0];
              x.parentNode.insertBefore(o,x);
              }
              }
              function gid (id){
              return document.getElementById(id);
              }
              window.onload = function() {

              e = gid("s-twitter");
              e.setAttribute("data-lang", "ru");

              e = gid("s-facebook");
              e.setAttribute("data-layout", "button_count");
              e.setAttribute("data-send", "false");

              e = gid("s-google");
              e.setAttribute("data-size", "medium");


              async_load("//platform.twitter.com/widgets.js", "id-twitter");//twitter
              async_load("//connect.facebook.net/ru_RU/all.js#xfbml=1", "id-facebook");//facebook
              async_load("https://apis.google.com/js/plusone.js", "id-google");//google
              async_load("//vk.com/js/api/openapi.js", "id-vkontakte");//vkontakte
              }
              // Инициализация vkontakte
              window.vkAsyncInit = function(){
              VK.init({apiId: 3363525, onlyWidgets: true});
              VK.Widgets.Like("vk_like", {type: "button", height: 20});
              }
              })(); */
            ?>
        </script>
        <?php
    }
    if ($app['counter_mail']) {
        ?>

        <!-- Rating@Mail.ru counter -->
        <script type="text/javascript">
            var _tmr = window._tmr || (window._tmr = []);
            _tmr.push({
                id: "1918735",
                type: "pageView",
                start: (new Date()).getTime()
            });
            (function (d, w, id) {
                if (d.getElementById(id))
                    return;
                var ts = d.createElement("script");
                ts.type = "text/javascript";
                ts.async = true;
                ts.id = id;
                ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                var f = function () {
                    var s = d.getElementsByTagName("script")[0];
                    s.parentNode.insertBefore(ts, s);
                };
                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "topmailru-code");
        </script>
        <noscript>
            <div style="position:absolute;left:-10000px;">
                <img src="//top-fwz1.mail.ru/counter?id=1918735;js=na"
                     style="border:0;" height="1" width="1"
                     alt="Рейтинг@Mail.ru"/>
            </div>
        </noscript>
        <!-- //Rating@Mail.ru counter -->

        <?php
        /*
          <!-- Rating@Mail.ru logo -->
          <a href="http://top.mail.ru/jump?from=1918735">
          <img src="//top-fwz1.mail.ru/counter?id=1918735;t=479;l=1"
          style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru" /></a>
          <!-- //Rating@Mail.ru logo -->
         */
    }
    if ($app['counter_yandex']) {
        ?>

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript"> (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter1689385 = new Ya.Metrika({
                            id: 1689385,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true
                        });
                    } catch (e) {
                    }
                });
                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"), f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";
                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");</script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/1689385"
                      style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript> <!-- /Yandex.Metrika counter -->
        <?php
    }
    ?>

    <!--/noindex-->

</div>

<?php
$mySape = '';
if (isset($app['sape'])) {
    $sape = $app['sape'];
    $mySape = str_replace(". .  ", ".<br/>", $sape->return_links());
}
?>

<div style="text-align: center;/*padding: 20px;*/">
    <?= $mySape; ?>
</div>

<?php
/*
  $s1 = $sape->return_links(2);
  $s2 = $sape->return_links();

  if ($s1 !='' || $s2 !='') echo '<div style="padding:5px 0;width:100%;float:left;">';

  if ($s1 !='') echo '<div style="float:right;">'.$s1.'</div>';
  if ($s2 !='') echo '<div style="float:left;">'.$s2.'</div>';

  if ($s1 !='' || $s2 !='') echo '</div>';
 */
/*
  <div style="padding:5px 0;width:100%;float:left;">
  <div style="float:right;">Проверка, проверочка, справа</div>
  <div style="float:left;">Проверка, слева</div>
  </div>
 */
?>
