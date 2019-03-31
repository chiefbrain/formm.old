<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 01.12.18
 * Time: 0:03
 */

namespace App;

use App\Add\Db;

class App
{
    private $root;

    /** @var Db */
    private $db;

    private $config;

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $env;
    private $files;
    private $session;

    private $referer;

    public function __construct()
    {
        $this->root = $_SERVER['DOCUMENT_ROOT'];
        $this->db = new Db();

        $this->get = isset($_GET) ? $_GET : null;
        $this->post =  isset($_POST) ? $_POST : null;
        $this->server =  isset($_SERVER) ? $_SERVER : null;
        $this->cookie =  isset($_COOKIE) ? $_COOKIE : null;
        $this->env =  isset($_ENV) ? $_ENV : null;
        $this->files =  isset($_FILES) ? $_FILES : null;
        $this->session =  isset($_SESSION) ? $_SESSION : null;

        $this->referer = array_key_exists('HTTP_REFERER', $_SERVER)
            ? $_SERVER['HTTP_REFERER'] : null;
    }

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return mixed
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @return mixed
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return string|null
     */
    public function getReferer()
    {
        return $this->referer;
    }

    public function run()
    {
        // TODO
    }

}