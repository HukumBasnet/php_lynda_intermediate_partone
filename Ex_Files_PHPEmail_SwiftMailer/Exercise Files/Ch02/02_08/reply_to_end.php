<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Reply-To Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('Click the Reply button in your email program');

    $email = "david@example.com\r\nCc: another@foundationphp.com";

    // validate email address
    if (Swift_Validate::email($email)) {
        $message->setReplyTo($email);
    }

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