<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Swift_MailTransport Test')
        ->setFrom($from)
        ->addTo($test, 'Test Account 1')
        ->addTo($private, 'David Powers')
        ->setBody('This message was sent using the transport of last resort');

    // create the transport
    $transport = null;
    $mailer = Swift_Mailer::newInstance($transport);
    $result = $mailer->send($message);
    if ($result) {
        echo "Number of emails sent: $result";
    } else {
        echo "Couldn't send email";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}