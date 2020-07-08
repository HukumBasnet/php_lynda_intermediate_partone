<?php
require_once '../../includes/config.php';

$recipients = [
    [
        'email' => 'testing@foundationphp.com',
        'name' => 'Test Account 1',
        'greeting' => 'David'
    ],
    [
        'email' => 'another@foundationphp.com',
        'name' => 'Test Account 2',
        'greeting' => 'A.N. Other'
    ],
    [
        'email' => 'someone@foundationphp.com',
        'name' => 'Test Account 3',
        'greeting' => "someone, who's really somebody"
    ],
    [
        'email' => 'secret@foundationphp.com',
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
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);

    // create and register decorator
    $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
    $mailer->registerPlugin($decorator);

    // create throttler
    $throttler = new Swift_Plugins_ThrottlerPlugin(5 * 1024 * 1024); // 5 MB/minute
    $throttler = new Swift_Plugins_ThrottlerPlugin(100, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE);

    $mailer->registerPlugin($throttler);

    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Anti-flood test for #name#')
        ->setFrom($from)
        ->setBody('Hi, #greeting#. This is a test of the anti-flood plugin.');

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