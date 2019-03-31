<?php

namespace App\Index;

class Url
{

    protected
            $app,
            $ajax,
            $adminka,
            $template,
            $languages,
            $prefixlang,
            $component,
            $detail_url,
            $url,
            $query,
            $routing;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function get()
    {
        $app       = $this->app;
        $separator = '-';
        /* - Обработка url начало - */

        $url   = $_SERVER['REQUEST_URI']; // Получаем URL
//$query=strrchr($url, '?');
        $query = strstr($url, '?');
        $url   = str_replace($query, '', $url); /* Удаляем "?..." */

        if ($url == '/')
        {
            $expurl = array($app['defaultlang'], $app['main']);
        }
        else
        {

            /* если папка добавляем / на конце */
            $sl  = strrchr($url, '/');
            $pos = strpos($sl, '.');
            if ($pos === false)
            {
                if (substr($url, -1) !== '/')
                {
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . $url . '/' . $query);
                    exit;
                }
            }
            /* ################################ */


            if (substr($url, -1) == '/' || substr($url, -1) == '-')
            { // если на конце url '/' || '-' удаляим их.
                $url = substr($url, 0, -1);
                //header ("Location: http://".$_SERVER['HTTP_HOST'].$url.$query);
                //exit;
            }

            $url = str_replace('/', '-', $url); // Для совместимости ?????!

            $url    = substr($url, 1); // удаляем '/' перед url
            $expurl = explode($separator, $url); // раскладываем url

            if ($expurl[0] == 'ajax')
            { // отслеживаем ajax
                $this->ajax = true;
                array_shift($expurl);
            }
            else
            {
                $this->ajax = false;
            }

            if (strlen($expurl[0]) != 2)
            { // если нулевое значение != двум символам, делаем вывод, что язык не указан
                array_unshift($expurl, $app['defaultlang']); // Добавляем указатель на язык
            }
            if (!isset($expurl[1]))
            {
                $expurl[] = $app['main']; // если $expurl[1] не существует присваемаем $expurl[1] - $GLOBALS['main']
            }
        }

// если последний элемент $expurl содержит '.html' на конце, добавляем в $expurl указатель на обработчик
        if (substr(end($expurl), -5) == '.html')
            $typehtml = true;
        else
            $typehtml = false;

        if ($expurl[1] == $app['codeword'])
        {//'admin') // отслеживаем админку
            $this->adminka = true;
            $expurl[1]     = $expurl[0];
            array_shift($expurl);
            if (isset($expurl[1]) && $expurl[1] == '')
                $sep           = '';
            else
                $sep           = '/';
            $this->routing = '/administration' . $sep;
        }
        else
        {
            $this->adminka = false;
            $this->routing = '/components/';
        }

        if ($this->adminka && $app['ADMIN'])
        { // отслеживаем админку для подгрузки шаблона
            $this->template = $app['ATPL'];
            if ($typehtml)
            {
                array_unshift($expurl, $expurl[0]);
                $expurl[1] = $expurl[2];
                $expurl[2] = $app['html'];
            }
        }
        else
        {

            $this->template = $app['STPL'];
            if ($typehtml && !file_exists($app['root'] . '/components/' . $expurl[1] . '/index.php'))
            {//Проверяем наличие .html на конце и отсутствие компонента обработчика
                // что бы присвоить обработчик по умолчанию
                array_unshift($expurl, $expurl[0]);
                $expurl[1] = $app['html'];
            }
        }

//echo '$expurl[0] = '.$expurl[0].' $expurl[1] = '.$expurl[1].' $expurl[2] = '.$expurl[2];

        $this->languages  = array_shift($expurl);
        if ($this->languages == $app['defaultlang'])
            $this->prefixlang = '';
        else
            $this->prefixlang = '/' . $this->languages;


        $this->component  = array_shift($expurl);
        $this->detail_url = $expurl;

        $_url = '';
        foreach ($expurl as $eurl)
        {
            $_url .= '/' . $eurl;
        }
        $this->url = $_url;

//define( 'QUERY', substr($query, 1));
        $this->query = substr($query, 1); // Все после ? из URL
//echo '$GLOBALS[url] = '.$GLOBALS['url'];

        /* - Обработка url конец - */

        return [
            'adminka'    => $this->adminka,
            'template'   => $this->template,
            'languages'  => $this->languages,
            'prefixlang' => $this->prefixlang,
            'component'  => $this->component,
            'detail_url' => $this->detail_url,
            'url'        => $this->url,
            'query'      => $this->query,
            'routing'    => $this->routing
        ];
    }

}

//defined('PROTECT') or die('Restricted access');


