<?php

use App\Model\MailerConfigModel;
use App\Model\MailerSendModel;
use App\Add\GeneralMailer;

defined('PROTECT') or die('Restricted access');

$subject = $data['subject'];
$to = $data['user_email'];
//$text    = 'Здравствуйте, ' . $_name . ' !<br/><br/>' .
//        'Вы зарегистрировали форму обратной связи на странице:<br/><a  href="http://www.' . $_link . '">' . $_link . '</a><br/><br/>' .
//        'Наш сервис является бесплатным. Если наша форма обратной связи Вам понравилась,' .
//        '<a  href="http://formm.ru/donate.html">можете выразить свою благодарность по ссылке</a> http://formm.ru/donate.html.<br/>';
$data['confirm'] = true;
ob_start();
require 'view/first_confirm.php';
$text = ob_get_clean();

// Конфиг для инициализации класса
/** @var MailerConfigModel $conf */
$conf = $app['mail'];

// Сама инициализация (нужно вызвать только один раз), вернет класс для работы с SMTP-сервером
//$mail = init($conf);
$mail = new GeneralMailer($conf);

// Если не залогинились - echo, иначе отправляем письмо с аттачем
//if ( ! $mail->isLogin) {
if ( $mail->getException() !== null) {
    $this->report(
        '<p style="color:red;">'
        . 'Ошибка SMTP!<br/>'
        . 'Попробуйте отправить сообщение позже.<br/>'
        . $mail->getException()->getMessage()
        . '</p>',
        $app['REFERER'],
        'red',
        30
    );
} else {
//    $realFrom = $conf->getLogin(); // От кого "реальный адрес"
//    $from = $conf->getLogin(); //$email;              // От кого

    $sendConf = (new MailerSendModel())
        ->setReplyTo($conf->getLogin())
        ->setRealFrom($conf->getLogin())
        ->setFrom($conf->getLogin())
        ->setTo($to)
        ->setSubject($subject)
        ->setMsg($text);

    if ($mail->send($sendConf)) {
        // Очищаем все аттачи для последующих отправок, использующих этот же инстанс класса работы с SMTP-сервером
//        $mail->clearAttachments();
        $this->report(
            'Вы успешно зарегистрировали форму обратной связи!<br/>'
            . 'Подтвердите регистрацию, пройдя по ссылке из письма!<br/>',
            $app['REFERER'],
            'green',
            30
        );

    } else {
        $this->report(
            'Что то пошло не так!<br/>'
            . 'Сообщение НЕ отправлено!<br/>'
            . $mail->getException()->getMessage(),
            $app['REFERER'],
            'red',
            30
        );
    }
}

// Инициализация класса работы с SMTP-сервером
//function init($conf)
//{
//    $mail = new \App\Add\KMMailer(
//        $conf['server'], $conf['port'], $conf['login'], $conf['password'],
//        $conf['secure']
//    );
//    $mail->xMailer = $conf['xMailer'];
//    $mail->senderName = $conf['sender'];
//
//    return $mail;
//}
