<?php
defined('ADMIN') or die('Restricted access');

$lang = $this->lng(dirname(__FILE__));

$lng = $app['languages'];

$url = $app['root'] . '/modules/head/head_' . $lng . '.lng';
$content = file_get_contents($url);
?>
<form action="/<?= $app['codeword']; ?>/save/" method="post">
    <table class="atab">
        <tr>
            <td>
                <input class="apbut" type="submit" value="<?= $lang[0]; ?>" />
                <?= $lang[1]; ?>
            </td>
        </tr>
        <tr>
            <td>

                <textarea style="width:100%;height:300px;" name="content" rows="10" cols="180"><?= $content; ?></textarea>
                <input type="hidden" name="url" value="<?= $url; ?>"/>
                <input type="hidden" name="action" value="action"/>
            </td>
        </tr>
    </table>
</form>