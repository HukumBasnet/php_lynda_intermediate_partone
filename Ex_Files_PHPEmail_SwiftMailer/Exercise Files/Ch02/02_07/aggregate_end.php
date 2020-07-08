<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Aggregate Transport Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This message was sent using an aggregate transport');

    // create single transports
    $nonexistent = Swift_SmtpTransport::newInstance('mail.example.com');
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);

    // create aggregate transport
    $aggregate = Swift_FailoverTransport::newInstance([$nonexistent, $transport]);
    $mailer = Swift_Mailer::newInstance($aggregate);
    $result = $mailer->send($message);
    if ($result) {
        echo "Number of emails sent: $result";
    } else {
        echo "Couldn't send email";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}