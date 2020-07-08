<?php
require_once '../../includes/config.php';
require_once './MyDecorator.php';

try {
    // connect to database
    $conn = new mysqli('localhost', 'swiftmailer', 'lynda', 'test');

    // get recipients
    $recipients = [];
    $sql = 'SELECT address, name FROM users';
    $result = $conn->query($sql);
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $recipients[$i]['email'] = $row['address'];
        $recipients[$i]['name'] = $row['name'];
        $i++;
    }

    // create the transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
        ->setUsername($username)
        ->setPassword($password);
    $mailer = Swift_Mailer::newInstance($transport);

    // create and register decorator
    $decorator = new Swift_Plugins_DecoratorPlugin(new MyDecorator($conn));
    $mailer->registerPlugin($decorator);

    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Personalized Message for #name#')
        ->setFrom($from)
        ->setBody('Hi, #greeting#. This message has been personalized just for you.');


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