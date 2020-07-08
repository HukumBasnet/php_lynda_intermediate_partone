<?php
require_once '../../includes/config.php';

try {
    // options
    $priority = '1';
    $priority = (int) $priority;
    $requestReceipt = true;

    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Headers Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This email was sent with highest priority and requests a receipt');

    // control the options
    if ($priority >= 1 && $priority <= 5) {
        $message->setPriority($priority);
    }
    if ($requestReceipt) {
        $message->setReadReceiptTo($secret);
    }

    // get headers
    $headers = $message->getHeaders();
    $headers->addTextHeader('X-PHP-Version', phpversion());

    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);
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