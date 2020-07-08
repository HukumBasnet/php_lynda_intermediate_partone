<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Encrypted SMTP Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This message was sent using an encrypted connection and self-signing');

    // create the transport, setting stream options to accept a self-signed certificate
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setStreamOptions(['ssl' =>
            ['verify_peer' => true,
            'verify_peer_name' => true,
            'allow_self_signed' => true]
        ])
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