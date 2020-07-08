<?php
require_once '../../includes/config.php';

$recipients = [
    [
        'email' => $testing,
        'name' => 'Test Account 1',
        'greeting' => 'David'
    ],
    [
        'email' => $test2,
        'name' => 'Test Account 2',
        'greeting' => 'A.N. Other'
    ],
    [
        'email' => $test3,
        'name' => 'Test Account 3',
        'greeting' => "someone, who's really somebody"
    ],
    [
        'email' => $secret,
        'name' => 'Test Account 4',
        'greeting' => 'shy one'
    ]
];

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Personalized Message')
        ->setFrom($from)
        ->setBody('This message has been personalized just for you.');

    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);

    // tracking variables
    $sent = 0;
    $failures = [];

    // send the personalized message to each recipient


    // display result
    if ($sent) {
        echo "Number of emails sent: $sent<br>";
    }
    if ($failures) {
        echo "Couldn't send to the following addresses:<br>";
        foreach ($failures as $failure) {
            echo $failure . '<br>';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}