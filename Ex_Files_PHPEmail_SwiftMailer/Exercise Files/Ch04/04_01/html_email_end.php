<?php
require_once '../../includes/config.php';

$html = <<<EOT
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Swift Mailer HTML Email Test</title>
</head>
<body bgcolor="#EBEBEB" link="#B64926" vlink="#FFB03B">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
<tr>
<td>
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td style="padding-top: 0.5em">
<h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #0E618C; text-align: center; border-bottom: solid 4px">HTML Email with Swift Mailer</h1>
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>To send HTML email with Swift Mailer, simply pass the HTML markup to the <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">setBody()</code> method of the message object, and set the second argument to <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">'text/html'</code>.</p>
<p><a href="http://swiftmailer.org/docs/messages.html#setting-the-body-content" target="_blank" style="font-weight: bold; text-decoration: none">As the Swift Mailer documentation explains</a>, you should always add a plain text version of the content using the <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">addPart()</code> method.</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
EOT;

$text = <<<EOT
HTML Email with Swift Mailer

To send HTML email with Swift Mailer, simply pass the
HTML markup to the setBody() method of the message object,
and set the second argument to 'text/html'.

As the Swift Mailer documentation explains
(http://swiftmailer.org/docs/messages.html#setting-the-body-content),
you should always add a plain text version of the content
using the addPart() method.
EOT;

try {
    // prepare email message
    $message = Swift_Message::newInstance()
        ->setSubject('Swift Mailer HTML Email Test')
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