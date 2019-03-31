<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 27.03.19
 * Time: 21:06
 */

namespace App\Model;

/**
 * Class MailerConfig
 *
 * @package App\Model
 */
class MailerConfigModel
{
    /** @var string */
    const SECURE_SSL = 'ssl';

    /** @var string */
    const SECURE_TLS = 'tls';

    /** @var string */
    protected $server;

    /** @var int */
    protected $port;

    /** @var string */
    protected $login;

    /** @var string */
    protected $password;

    /** @var string */
    protected $secure;

    /** @var null | string */
    protected $xMailer = null;

    /** @var null | string */
    protected $sender = null;

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
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param $port
     *
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param $login
     *
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
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
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param $secure
     *
     * @return $this
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getXMailer()
    {
        return $this->xMailer;
    }

    /**
     * @param $xMailer
     *
     * @return $this
     */
    public function setXMailer($xMailer)
    {
        $this->xMailer = $xMailer;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param $sender
     *
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }
}
