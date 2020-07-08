<?php
require_once '../../includes/config.php';

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Cc/Bcc Test')
        ->setFrom($from)
        ->setTo($test1)
        //->setCc([$test2 => 'Test Account 2', $test3 => 'Test Account 3'])
        ->addCc($test2, 'Test Account 2')
        ->addCc($test3, 'Test Account 3')
        ->setBcc($secret)
        ->setBody('This email has been copied to other recipients');

    $email_address = 'david@example.com';

    // validate email address
    if (Swift_Validate::email($email_address)) {
        $message->setReplyTo($email_address);
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