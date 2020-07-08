<?php
require_once '../../includes/config.php';
require_once './create_image.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Dynamic Attachment Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody('This message has a dynamically generated file attached to it');

    // generate dynamic image
    $image_data = randomSwatch();

    // attach dynamic file
    $attachment = Swift_Attachment::newInstance($image_data, 'swatch.png', 'image/png');
    $message->attach($attachment);

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