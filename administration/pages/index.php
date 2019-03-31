<?php
defined('ADMIN') or die('Restricted access');

$lang = $this->lng(dirname(__FILE__));

include $app['root'] . '/modules/menu/config.php';
$mlng = $this->lng($app['root'] . '/modules/menu/');

//if (LNG != '') $lng='/'.LNG;
$lng = $app['prefixlang'];

$mlng[] = $lang[0];
$links[] = '/404.html';

if (isset($_GET['link']) && $_GET['link'] != '')
{
    $lnk = $links[$_GET['link']];
    if ($lnk == '/')
        $lnk .= $app['main'];
    $content = file_get_contents($app['root'] . '/data' . $lng . $lnk);
    $url = $app['root'] . '/data/' . $lng . $lnk;
    ?>
    <form action="/<?= $app['codeword']; ?>/save/" method="post">
        <table class="atab">
            <tr>
                <td>
                    <input class="apbut" type="button" value="<?= $lang[3]; ?>" onclick="window.location.href = '<?= $lng; ?>/<?= $app['codeword']; ?>/'" />
                    <input class="apbut" type="submit" value="<?= $lang[4]; ?>" />
    <?= $lang[5] . $mlng[$_GET['link']]; ?>
                </td>
            </tr>
            <tr>
                <td>

                    <script type="text/javascript" src="/general/ckeditor/ckeditor.js"></script>
                    <textarea style="display:none;" class="ckeditor" name="content" rows="10" cols="180"><?= htmlspecialchars($content); ?></textarea>
                    <input type="hidden" name="url" value="<?= $url; ?>"/>
                    <input type="hidden" name="action" value="action"/>


                </td>
            </tr>
        </table>
    </form>
    <?php
}
else
{
    $z = 0;
    ?>
    <table class="atab">
        <tr>
            <th><?= trim($lang[1]); ?></th>
            <th><?= trim($lang[2]); ?></th>
        </tr>


        <?php
        foreach ($links as $link)
        {
            /* if ($link!='/') {
              if (stripos(URL, $lng.$link)===0) $DopStyle=$StyleSelectPoint; else $DopStyle='';
              } else if (URL == $lng.'/') $DopStyle=$StyleSelectPoint; else $DopStyle=''; */
            $link = trim($link);
            if ($link == '/')
            {
                $link .= $app['main'];
            }
            $suff = substr($link, -5);

            if ($suff == '.html')
            {
                ?>
                <tr>
                    <td><a href="?link=<?= $z; ?>"><?= $mlng[$z]; ?></a></td>
                    <td><?= $link; ?></td>
                </tr>
            <?php
        }
        $z++;
    }
    ?>
    </table>
    <?php
}