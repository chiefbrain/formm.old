<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 12.11.18
 * Time: 23:05
 */

//namespace App\Service\Captcha;

/**
 * Class Captcha
 * @package App\Service\Captcha
 */
class Captcha
{
    # CAPTCHA image size (you do not need to change it, whis parameters is optimal)
    protected $width = 100; // 160, //
    protected $height = 50; // 80, //

    protected $foreground_color = [0, 0, 0];
    protected $background_color = [255, 255, 255];//array(220, 230, 255),

    # symbols used to draw CAPTCHA
    protected $allowed_symbols = '23456789'; //abcdeghkmnpqsuvxyz'; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)

    protected $fontMin = 0;
    protected $fontMax = 2;

    # CAPTCHA string length
    protected $lengthMin = 4;
    protected $lengthMax = 4;

    protected $gapMin = 0; // минимальный пробел
    protected $gapMax = 10;

    # symbol's vertical fluctuation amplitude divided by 2
    protected $fluctuation_amplitude = 5;

    #
    protected $interference = true;

    # show credits
    protected $show_credits = false; # set to false to remove credits line. Credits adds 12 pixels to image height
    protected $credits = 'www.getCaptcha.ru'; # if empty, HTTP_HOST will be shown

    # JPEG quality of CAPTCHA image (bigger is better quality, but larger file size)
    protected $jpeg_quality = 95;

    ##############################

    /** @var string */
    protected $keystring;

    /**
     * Captcha constructor.
     */
    public function __construct()
    {

    }

    /**
     * generates keystring and image
     *
     * @return array
     */
    public function getCaptcha()
    {
        $img = $this->getImg();

        $imgType = '';

        ob_start();

        if (function_exists("imagejpeg")) {
            $imgType = "image/jpeg";
            imagejpeg($img, null, $this->jpeg_quality);
        } else if (function_exists("imagegif")) {
            $imgType = 'image/gif';
            imagegif($img);
        } else if (function_exists("imagepng")) {
            $imgType = "image/x-png";
            imagepng($img);
        }

        $__img = trim(ob_get_clean());

        $hash = password_hash($this->keystring, PASSWORD_DEFAULT, ['cost' => 4]);

        return [
            'headers' => [
                'set-cookie' => 'CAPTCHAHASH=' . $hash,
                'cache-control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'content-type' => $imgType
            ],
            'img' => $__img,
            'hash' => $hash
        ];
    }

    /**
     * @return resource
     */
    private function getImg()
    {
        $width = $this->width;
        $height = $this->height;

        $img1 = $this->getImgF();
        $img2 = imagescale ( $img1 , $width, $height);//, IMG_BILINEAR_FIXED);

        if ($this->interference) {
            $img2 = $this->interference($img2);
        }

        return $this->wave($img2);
    }

    /**
     * @return resource
     */
    private function getImgF()
    {
        $fonts = [
            [
                'font' => 'actionJackson',
                'fw' => 20,//30,
                'fh' => 35,
                'fd' => 40,
                'chars' => $this->allowed_symbols
            ], [
                'font' => 'monsterShadow',
                'fw' => 20,//30,
                'fh' => 35,
                'fd' => 35,
                'chars' => $this->allowed_symbols
            ], [
                'font' => 'baveuse3d',
                'fw' => 25,//35,
                'fh' => 40,
                'fd' => 40,
                'chars' => $this->allowed_symbols
            ]
        ];

        $f = $fonts[mt_rand($this->fontMin, $this->fontMax)];

        $font = __DIR__ . '/fonts/' . $f['font'] . '.ttf';
        $fw = $f['fw'];
        $fh = $f['fh'];
        $fd = $f['fd'];
        $chars = $f['chars'];

        $len = strlen($chars) - 1;

        $length = mt_rand($this->lengthMin, $this->lengthMax);

        $gap = [];
        $gaps = 0;
        for ($i = 0; $i < ($length - 1); $i++) {
            $g = mt_rand($this->gapMin, $this->gapMax);
            $gap[] = $g;
            $gaps += $g;
        }

        $x = 15; // отступы справа и слева, сверху и снизу
        $charRotate = 1;
        $w = $fw * $length + $gaps + $x * 2;
        $h = $fh + $this->fluctuation_amplitude + $x;
        $imgF = imagecreatetruecolor($w, $h) or die('Несоздается...');
        $bg = imagecolorallocate($imgF, 255, 255, 255);
        imagefill($imgF, 0, 0, $bg);
        $color = imagecolorallocate($imgF, 0, 0, 0);

        for ($i = 0; $i < $length; $i++) {
            $ck = mt_rand(0, $len);
            $char = $chars{$ck};
            $this->keystring .= $char;

            $y = mt_rand(0, $this->fluctuation_amplitude);

            imagettftext($imgF, 30, mt_rand(-$charRotate, $charRotate), $x, $y + $fd, $color, $font, $char);

            $g = 0;
            if (isset($gap[$i])) {
                $g = $gap[$i];
            }
            $x += $fw + $g;
        }
        return $imgF;
    }

    /**
     * ШУМ
     *
     * @param $img
     * @return mixed
     */
    private function interference($img)
    {
        $width = $this->width;
        $height = $this->height;

        $intnsv = rand(10, 50);
        for ($i = 0; $i < $intnsv; $i++) {
            $x1 = rand(0, $width);
            $y1 = rand(0, $height);
            $f1 = rand(0, 5);

            $c1 = ImageColorAllocate($img, 0, 0, 0);
            imagechar($img, $f1, $x1, $y1, '.', $c1);
        }
        return $img;
    }

    /**
     * @param $img2
     * @return resource
     */
    private function wave($img2)
    {
        $width = $this->width;
        $height = $this->height;
        $foreground_color = $this->foreground_color;
        $background_color = $this->background_color;

        $center = $width / 2; //$x / 2;

        $img3 = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($img3, $background_color[0], $background_color[1], $background_color[2]);
        imagefilledrectangle($img3, 0, 0, $width - 1, $height - 1, $bg);

        $foreground = imagecolorallocate($img2, $foreground_color[0], $foreground_color[1], $foreground_color[2]);
        imagefilledrectangle($img2, 0, $height, $width - 1, $height + 12, $foreground);

        // periods
//        $rand1 = mt_rand(750000, 1200000) / 10000000;
//        $rand2 = mt_rand(750000, 1200000) / 10000000;
//        $rand3 = mt_rand(750000, 1200000) / 10000000;
//        $rand4 = mt_rand(750000, 1200000) / 10000000;

        $rand1 = mt_rand(75, 120) / 1000;
        $rand2 = mt_rand(75, 120) / 1000;
        $rand3 = mt_rand(75, 120) / 1000;
        $rand4 = mt_rand(75, 120) / 1000;
        // phases
        $rand5 = mt_rand(0, 31415926) / 10000000;
        $rand6 = mt_rand(0, 31415926) / 10000000;
        $rand7 = mt_rand(0, 31415926) / 10000000;
        $rand8 = mt_rand(0, 31415926) / 10000000;
        // amplitudes
        //$rand9  = mt_rand(330, 420) / 110;
        //$rand10 = mt_rand(330, 450) / 110;
        $rand9 = mt_rand(220, 330) / 110;
        $rand10 = mt_rand(220, 330) / 110;
        //wave distortion

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $sx = (int)round($x + (sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6)) * $rand9 - $width / 2 + $center + 1, 0);
                $sy = (int)round($y + (sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8)) * $rand10, 0);

                if ($sx < 0 || $sy < 0 || $sx >= $width - 1 || $sy >= $height - 1) {
                    continue;
                } else {
                    $color = imagecolorat($img2, $sx, $sy) & 0xFF;
                    $color_x = imagecolorat($img2, $sx + 1, $sy) & 0xFF;
                    $color_y = imagecolorat($img2, $sx, $sy + 1) & 0xFF;
                    $color_xy = imagecolorat($img2, $sx + 1, $sy + 1) & 0xFF;
                }

                if ($color == 255 && $color_x == 255 && $color_y == 255 && $color_xy == 255) {
                    continue;
                } else if ($color == 0 && $color_x == 0 && $color_y == 0 && $color_xy == 0) {
                    $newred = $foreground_color[0];
                    $newgreen = $foreground_color[1];
                    $newblue = $foreground_color[2];
                } else {
                    $frsx = $sx - floor($sx);
                    $frsy = $sy - floor($sy);
                    $frsx1 = 1 - $frsx;
                    $frsy1 = 1 - $frsy;

                    $newcolor = (
                        $color * $frsx1 * $frsy1 +
                        $color_x * $frsx * $frsy1 +
                        $color_y * $frsx1 * $frsy +
                        $color_xy * $frsx * $frsy);

                    if ($newcolor > 255) {
                        $newcolor = 255;
                    }
                    $newcolor = $newcolor / 255;
                    $newcolor0 = 1 - $newcolor;

                    $newred = $newcolor0 * $foreground_color[0] + $newcolor * $background_color[0];
                    $newgreen = $newcolor0 * $foreground_color[1] + $newcolor * $background_color[1];
                    $newblue = $newcolor0 * $foreground_color[2] + $newcolor * $background_color[2];
                }

                imagesetpixel($img3, $x, $y, imagecolorallocate($img3, (int)$newred, (int)$newgreen, (int)$newblue));
            }
        }

        return $img3;
    }
}