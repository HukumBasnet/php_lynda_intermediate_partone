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

    //tracking variables
    $sent = 0;
    $failures = [];

    // send individual emails
    foreach ($recipients as $key => $value) {
        if (is_int($key)) {
            $message->setTo($value);
        } else {
            $message->setTo([$key => $value]);
        }
        $sent += $mailer->send($message, $failures);
    }

    if ($sent) {
        echo "Number of emails sent: $sent<br>";
    }
    if ($failures) {
        echo "Couldn't send to the following addresses: <br>";
        foreach ($failures as $failure) {
            echo $failure . '<br>';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// inspect $recipients array
/*echo '<pre>';
print_r($recipients);
echo '</pre>';*/