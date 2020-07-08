<?php
require_once '../../includes/config.php';

$recipients = [
    $testing => 'Test Account 1',
    $test2,
    $test3 => 'Test Account 3',
    $secret
];

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Individually Addressed Message')
        ->setFrom($from)
        ->setBody('This message is being sent to multiple recipients, but is individually addressed.');

    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);
} catch (Exception $e) {
    echo $e->getMessage();
}

// inspect $recipients array
echo '<pre>';
print_r($recipients);
echo '</pre>';