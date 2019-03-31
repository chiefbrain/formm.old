<?php
defined('ADMIN') or die('Restricted access');

$lang = $this->lng(dirname(__FILE__));

$dir = $app['root'] . '/addons/';
$files = scandir($dir);

foreach ($files as $file)
{
    $type = substr($file, -5);
    if ($type == '.html' && $file != 'index.html')
    {
        $links[] = '/' . $file;
    }
}

//$lng = $app['languages'];
$lng = '';

if (isset($_GET['link']) && $_GET['link'] != '')
{
    $lnk = $links[$_GET['link']];
    $content = file_get_contents($app['root'] . '/addons' . $lng . $lnk);
    $url = $app['root'] . '/addons/' . $lng . $lnk;
    ?>
    <form action="/<?= $app['codeword']; ?>/save/" method="post">
        <table class="atab">
            <tr>
                <td>
                    <input class="apbut" type="button" value="<?= $lang[2]; ?>" onclick="window.location.href = '<?= $lng; ?>/<?= $app['codeword']; ?>/addons/'" />
                    <input class="apbut" type="submit" value="<?= $lang[3]; ?>" />
                    <?= $lang[4] . substr($lnk, 1, -5); ?>
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
} else
{
    $z = 0;
    ?>
    <table class="atab">
        <tr>
            <th><?= trim($lang[0]); ?></th>
            <th><?= trim($lang[1]); ?></th>
        </tr>


        <?php
        foreach ($links as $link)
        {
            ?>
            <tr>
                <td><a href="?link=<?= $z++; ?>"><?= substr($link, 1, -5); ?></a></td>
                <td><?= '/addons' . $link; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}