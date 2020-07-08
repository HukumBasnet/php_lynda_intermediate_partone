<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer SMTP Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This message was sent using the Swift Mailer SMTP transport');

    // create the transport

} catch (Exception $e) {
    echo $e->getMessage();
}