<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 13.12.18
 * Time: 23:23
 */

namespace App\Mail;

use App\Add\KMMailer;

class Mailer
{
    /** @var KMMailer  */
    private $mailer;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $this->mailer = new KMMailer(
            'smtp.yandex.ru',
            465,
            'mail@formm.ru',
            'Qp8zUNiX', //'44lkkkkl',
            'ssl' // null, tls, ssl,
        );

        $this->mailer->xMailer = 'Online service formm.ru';
    }

    /**
     * @return KMMailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

}