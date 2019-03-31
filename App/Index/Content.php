<?php

namespace App\Index;

class Content
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }


    public function make()
    {
        /* Вставка шаблона и блоков начало */
        $app = $this->app;
        $f = $app['f'];
        $j = '<bloc-template/>';

        //return '!!!!!!!!!!!!!!!';
        
        ob_start();
        $j = $f->jblock('template', '/templates/' . $app['template'] . '/index.php', $j); // Вставка шаблона
        $j = str_replace('<bloc-template/>', '', $j);


// LOGOUT или загрузка Компонента

        if (($app['component'] == 'exit' || end($app['detail_url']) == 'exit' || isset($_REQUEST['exit'])) && ($app['ADMIN'] || $app['USER']))
            $com = '/includes/login/exit.php';
        else
            $com = $app['routing'] . $app['component'] . '/index.php';



        $j = $f->jblock('content', $com, $j); // Вставка контента
        $j = str_replace('<bloc-content/>', '', $j);

        $allblocks = [];
        preg_match_all("/<bloc-.+\/>/Uis", $j, $allblocks);
        
        $alladdons = [];
        preg_match_all('/<add-.+\/>/Uis', $j, $alladdons);

//foreach ($arr_modul as $arf) {
        foreach ($allblocks[0] as $arf)
        {
//$arf=trim($arf);
            $arf = str_replace('<bloc-', '', $arf);
            $arf = str_replace('/>', '', $arf);
            /* ---------------------------------- */
            $bl  = '/modules/' . $arf . '/' . $arf . '.php';
            $j   = $f->jblock($arf, $bl, $j); // Вставка модулей
            /* ---------------------------------- */
//$af = explode(";", $arf);
//$j=$f->jblock ($af[0],$af[1],$j); // Вставка модулей
        }

        foreach ($alladdons[0] as $arf)
        {
//$arf=trim($arf);
            $arf = str_replace('<add-', '', $arf);
            $arf = str_replace('/>', '', $arf);
            /* ---------------------------------- */
            $bl  = '/addons/' . $arf . '.php';
            $j   = $f->jaddon($arf, $bl, $j); // Вставка дополнений!
            /* ---------------------------------- */
        }

        ob_end_clean();
        return $j;
    }

    public function view($j)
    {
        $j = preg_replace('/<bloc-.+\/>/Uis', '', $j);
        $j = str_replace('<runtime/>', round(microtime(1) - $this->app['time_start'], 4), $j);
        echo $j;
    }

}

//defined('PROTECT') or die('Restricted access');

/* if (defined('ALOGIN') && defined('ADMIN')) $TPL=$ATPL; else $TPL=$STPL;
  define( 'TPL', $TPL); */


