<?php
require_once '../../includes/config.php';

$text = <<< EOT
Meet the ElePHPant

The ElePHPant is PHP's semi-official mascot, designed by Vincent Pontier (https://twitter.com/elroubio).

You can see how the ElePHPant was born in this movie on Vincent's website (http://www.elroubio.net/naissance_elephpant.php). But why an elePHPant? According to Vincent:

* Everyone likes this kind animal
* It's useful to humankind
* It's powerful, but gentle at the same time
* It's quick when it attacks (databases)
* The letters PHP form an elePHPant (take a close look)

Vincent has generously made the elePHPant logo available in many different formats. You can download your own set from www.elephpant.com.
EOT;


try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer Inline Image Test')
        ->setFrom($from)
        ->setTo($test1)
        ->setBody($html, 'text/html')
        ->addPart($text, 'text/plain');

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