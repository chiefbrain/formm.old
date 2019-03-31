<?php defined("PROTECT") or die("Restricted access"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <bloc-head/>
    </head>
    <body>
        <div id="wrap">
            <div class="bl head">
                <div class="logo"><add-logo/></div>
                <div class="banner"><add-banner/></div>
                <div class="menu"><bloc-menu/></div> 
            </div>
            <div class="bl">

                <?php
                //echo '$app[url]='.$app['url'];

                if ($app['url'] == '/' . $app['main'] || $app['url'] == '/mailto.php' || $app['component'] == 'regs')
                {
                    ?>
                    <div class="cont">
                        <div class="cont1"><bloc-social/><bloc-content/></div>
                        <div class="cont2"><bloc-anons/></div>
                        <div class="cont"><bloc-anons2/></div>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="cont"><bloc-social/><bloc-content/></div>
                <?php } ?>

                <div class="cont"><bloc-promo/></div>
            </div>
            <div class="bl foot">
                <add-bottom/>
                <bloc-count/>
                <runtime/>
            </div>
        </div>
    </body>
</html>
