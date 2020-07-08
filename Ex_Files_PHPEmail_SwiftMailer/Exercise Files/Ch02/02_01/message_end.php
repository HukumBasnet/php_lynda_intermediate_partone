<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Test of Swift Mailer')
        ->setFrom(['no-reply@foundationphp.com' => 'Foundation PHP'])
        //->setTo(['testing@foundationphp.com' => 'David Powers'])
        ->addTo('testing@foundationphp.com', 'David Powers')
        ->addTo('someone@example.com')
        ->addTo('yet_someonelse@example.com', 'Someone else')
        ->setBody('This is a test of Swift Mailer');
    echo $message->toString();
} catch (Exception $e) {
    echo $e->getMessage();
}