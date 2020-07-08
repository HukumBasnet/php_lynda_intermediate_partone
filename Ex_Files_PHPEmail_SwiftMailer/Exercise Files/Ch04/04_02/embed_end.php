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
        ->setTo($test1);

    // embed image
    $image = $message->embed(Swift_Image::fromPath('images/elephpant_281_193.png'));

    $html = <<<EOT
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Swift Mailer Inline Image Test</title>
</head>
<body bgcolor="#EBEBEB" link="#B64926" vlink="#FFB03B">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
<tr>
<td>
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td style="padding-top: 0.5em">
<h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #0E618C; text-align: center">Meet the ElePHPant</h1>
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>The ElePHPant is PHP's semi-official mascot, designed by <a href="https://twitter.com/elroubio" target="_blank" style="text-decoration: none; font-weight: bold">Vincent Pontier</a>.</p>
</td>
</tr>
<tr>
<td align="center">
<img src="$image" width="281" height="193"
     alt="Cartoon elephant with PHP on its side">
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>You can see how the ElePHPant was born in <a href="http://www.elroubio.net/naissance_elephpant.php" target="_blank"  style="text-decoration: none; font-weight: bold">this movie on Vincent's website</a>. But why an elePHPant? According to Vincent:</p>
<ul style="margin-left: 30px">
    <li>Everyone likes this kind animal</li>
    <li>It's useful to humankind</li>
    <li>It's powerful, but gentle at the same time</li>
    <li>It's quick when it attacks (databases)</li>
    <li>The letters PHP form an elePHPant (take a close look)</li>
</ul>
<p>Vincent has generously made the elePHPant logo available in many different formats. You can <a href="http://www.elephpant.com/#download" target="_blank" style="text-decoration: none; font-weight: bold">download your own set from www.elephpant.com</a>.</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
EOT;



        $message->setBody($html, 'text/html')
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