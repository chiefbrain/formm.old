<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 27.03.19
 * Time: 22:43
 */

namespace App\Model;

/**
 * Class MailerSendModel
 *
 * @package App\Model
 */
class MailerSendModel
{
    /** @var string */
    protected $realFrom;

    /** @var string */
    protected $from;

    /** @var string */
    protected $replyTo;

    /** @var string */
    protected $to;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $msg;

    /**
     * @return string
     */
    public function getRealFrom()
    {
        return $this->realFrom;
    }

    /**
     * @param $realFrom
     *
     * @return $this
     */
    public function setRealFrom($realFrom)
    {
        $this->realFrom = $realFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param $from
     *
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param $replyTo
     *
     * @return $this
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param $to
     *
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param $msg
     *
     * @return $this
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }
}
