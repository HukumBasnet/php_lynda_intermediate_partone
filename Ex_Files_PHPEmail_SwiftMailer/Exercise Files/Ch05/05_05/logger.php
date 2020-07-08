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

// build replacements array
$replacements = [];
foreach ($recipients as $recipient) {
    $replacements[$recipient['email']] = [
        '#name#' => $recipient['name'],
        '#greeting#' => $recipient['greeting']
    ];
}

try {
    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server)
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);

    // create and register decorator
    $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
    $mailer->registerPlugin($decorator);

    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Logger test for #name#')
        ->setFrom($from)
        ->setBody('Hi, #greeting#. This is a test of the logger plugin.');

    // tracking variables
    $sent = 0;
    $failures = [];

    // send the personalized message to each recipient
    foreach ($recipients as $recipient) {
        $message->setTo([$recipient['email'] => $recipient['name']]);
        $sent += $mailer->send($message, $failures);
    }

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