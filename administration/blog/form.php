<?
defined('USERS') or die('Restricted access');

//if (isset($row['id'])) $id=$row['id']; else $id='';
if (isset($row['title'])) $title = $row['title']; //else $title='';
if (isset($row['link'])) $link = $row['link']; //else $link='';;
if (isset($row['tags'])) $tags = $row['tags']; //else $tags='';
if (isset($row['anons'])) $anons = $row['anons']; //else $anons='';
if (isset($row['text'])) $text = $row['text']; //else $text='';

$lng = '';

$lang = $this->lng(__DIR__);

?>
<script type="text/javascript" src="/general/ckeditor/ckeditor.js"></script>

<form action="" method="post">
    <table class="atab">
        <tr>
            <td>
                <input class="apbut" type="button" value="<?= trim($lang[3]) ?>"
                       onclick="window.location.href='<?= $lng ?>/<?= $app['codeword'] ?>/<?= $dir ?>'"/>
                <input class="apbut" type="submit" value="<?= trim($lang[4]) ?>"/>
                <?= trim($lang[5]) . ' <b>"' . $link . '"</b> ' . $check_report ?>
            </td>
        </tr>
        <tr>
            <td>

                <table style="width:100%">
                    <tr>
                        <td style="width:50%;">
                            <p>Title:</p>
                            <input name="title" type="text" value="<?= $title ?>" maxlength="50"
                                   style="width:98%;height:20px;border:5px solid #c7c78f;"/>
                        </td>
                        <td>
                            <p>Link:</p>
                            <input name="link" type="text" value="<?= $link ?>" maxlength="50"
                                   style="width:98%;height:20px;border:5px solid #c7c78f;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Tags:</p>
                            <textarea style="width:98%;height:110px;border:5px solid #c7c78f;" name="tags" rows="10"
                                      cols="100"><?= $tags ?></textarea>
                        </td>
                        <td>
                            <p>Img:</p>
                            <iframe src="/general/upload_img_blog/index.php?id=<?= $id ?>"
                                    style="width:98%;height:110px;border:5px solid #c7c78f" scrolling="no"
                                    frameborder="0" marginheight="0" marginwidth="0"></iframe>
                        </td>
                    </tr>
                </table>

                <p>Anons:</p>
                <textarea style="display:none;" id="text1" name="anons" rows="10"
                          cols="100"><?= htmlspecialchars($anons) ?></textarea>
                <script type="text/javascript">
                    //<![CDATA[
                    CKEDITOR.replace('text1',
                        {
                            height: '150'
                        });
                    //]]>
                </script>
                <p>Text:</p>
                <textarea style="display:none;" class="ckeditor" name="text" rows="10"
                          cols="180"><?= htmlspecialchars($text) ?></textarea>

                <input type="hidden" name="url" value="<?= $url ?>"/>
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <input type="hidden" name="action" value="<?= $action ?>"/>

            </td>
        </tr>
    </table>
</form>