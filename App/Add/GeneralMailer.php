<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 27.03.19
 * Time: 20:53
 */

namespace App\Add;

use App\Model\MailerConfigModel;
use App\Model\MailerSendModel;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class GeneralMailer
 *
 * @package App\Add
 */
class GeneralMailer
{
    /** @var null | \Exception */
    protected $exception = null;

    /** @var PHPMailer  */
    protected $mailer;

    /**
     * GeneralMailer constructor.
     *
     * @param MailerConfigModel $config
     */
    public function __construct(MailerConfigModel $config)
    {
        try
        {
            $mail = new PHPMailer(); // Passing `true` enables exceptions

            /** Server settings */
            $mail->Host       = $config->getServer();   // Specify main and backup SMTP servers
            $mail->Username   = $config->getLogin();    // SMTP username
            $mail->Password   = $config->getPassword(); // SMTP password
            $mail->SMTPSecure = $config->getSecure();   // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = $config->getPort();     // TCP port to connect to
            $mail->XMailer    = $config->getXMailer();

//            $mail->SMTPDebug  = 2;                      // Enable verbose debug output
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->SMTPAuth   = true;                   // Enable SMTP authentication

            $this->mailer = $mail;
        }
        catch (\Exception $e)
        {
            $this->exception = $e;
        }
    }

    /**
     * Attachments
     *
     * @param string $path
     * @param string $name
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addAttachment($path, $name = '')
    {
        $this->getMailer()->addAttachment($path, $name);
    }

    /**
     * @param MailerSendModel $mod
     *
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send(MailerSendModel $mod)
    {
        $mail = $this->getMailer();
//        $mail->Sender     = $from;
        //Recipients
        $mail->setFrom($mod->getRealFrom());
        $mail->addAddress($mod->getTo());
        $mail->addReplyTo($mod->getReplyTo());
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Content
        $mail->isHTML(true);              // Set email format to HTML
        $mail->Subject = $mod->getSubject();
        $mail->Body    = $mod->getMsg();         // 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = strip_tags();         //'This is the body in plain text for non-HTML mail clients';

        return $mail->send();

    }

    /**
     * @return \Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return PHPMailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }
}
