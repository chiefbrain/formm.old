<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 03.11.18
 * Time: 14:20
 */

namespace App\Index;

/**
 * Class Sape
 * @package App\Index
 */
class Sape
{
    /**
     * @var \SAPE_client
     */
    private $sape;

    /**
     * @var \SAPE_context
     */
    private $sape_context;

    /**
     * Sape constructor.
     */
    public function __construct()
    {
        /* Подключаем SAPE - START */

        if (!defined('_SAPE_USER'))
        {
            define('_SAPE_USER', '69bf0e8bd43b8265980534637ed48273');
        }
        require_once realpath($_SERVER['DOCUMENT_ROOT'] . '/' . _SAPE_USER . '/sape.php');

//        global ;
//        global $sape_context;

        $o['charset'] = 'UTF-8';
        //$o['force_show_code'] = true;
        $this->sape         = new \SAPE_client($o);
        $this->sape_context = new \SAPE_context($o);
        unset($o);

        /* Подключаем SAPE - END */
    }

    /**
     * @return \SAPE_client
     */
    public function getSape()
    {
        return $this->sape;
    }

    /**
     * @return \SAPE_context
     */
    public function getSapeContext()
    {
        return $this->sape_context;
    }
}