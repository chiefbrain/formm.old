<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 27.03.19
 * Time: 21:41
 */

namespace App\Model;

/**
 * Class DbConfigModel
 *
 * @package App\Model
 */
class DbConfigModel
{
    /** @var string  */
    const DB_TYPE_MYSQL = 'mysql';

    /** @var string  */
    const DB_CHARSET_UTF8 = 'utf8';

    /** @var string */
    protected $database_type;

    /** @var string */
    protected $database_name;

    /** @var string */
    protected $server;

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $charset;

    /**
     * @return string
     */
    public function getDatabaseType()
    {
        return $this->database_type;
    }

    /**
     * @param $database_type
     *
     * @return $this
     */
    public function setDatabaseType($database_type)
    {
        $this->database_type = $database_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->database_name;
    }

    /**
     * @param $database_name
     *
     * @return $this
     */
    public function setDatabaseName($database_name)
    {
        $this->database_name = $database_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param $server
     *
     * @return $this
     */
    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param $charset
     *
     * @return $this
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }
}
