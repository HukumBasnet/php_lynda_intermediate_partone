<?php
$expected = ['name', 'email', 'ticket_type', 'dietary_needs', 'interests', 'accept_terms'];
$required = ['name', 'email', 'accept_terms'];

if (!isset($_POST['accept_terms'])) {
    $_POST['accept_terms'] = '';
}

// check $_POST array
foreach ($_POST as $key => $value) {
    if (in_array($key, $expected)) {
        if (!is_array($value)) {
            $value = trim($value);
        }
        if (empty($value) && in_array($key, $required)) {
            $$key = '';
            $missing[] = $key;
        } else {
            $$key = $value;
        }
    }
}

// check email address
if (!in_array($email, $missing)) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errors['email'] = 'Please use a valid email address';
    }
}

// process only if there are no errors or missing fields
if (!$errors && !$missing) {
    require_once __DIR__ . '/../../../includes/config.php';

    // set up replacements for decorator plugin
    $replacements = [
        $email =>
            ['#subject#' => 'Confirmation of Roux Art Conference registration',
                '#greeting#' => "$name, thank you for registering for the Roux Academy
            Art Conference. This is a record of your registration details.",
                '#photo#' => 'This photo will be used for your registration badge.'],
        'secret@foundationphp.com' =>
            ['#subject#' => "Art Conference Registration for $name",
                '#greeting#' => "Registration details for $name.",
                '#photo#' => 'Registration photo.']
    ];

    try {
        // create a transport
        $transport = Swift_SmtpTransport::newInstance($smtp_server, 465, 'ssl')
            ->setUsername($username)
            ->setPassword($password);
        $mailer = Swift_Mailer::newInstance($transport);

// register the decorator and replacements
        $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
        $mailer->registerPlugin($decorator);

// initialize the message
        $message = Swift_Message::newInstance()
            ->setSubject('#subject#')
            ->setFrom($from);

// create the first part of the HTML output
        $html = <<<EOT
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Art Conference Registration</title>
</head>
<body bgcolor="#EBEBEB" link="#B64926" vlink="#FFB03B">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
<tr>
<td>
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td style="padding-top: 0.5em">
<h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #0E618C; text-align:
center">Art Conference Registration</h1>
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>#greeting#</p>
<ul>
EOT;

        // initialize variable for plain text version
        $text = '';

        // add each form element to the HTML and plain text content
        foreach ($expected as $item) {
            if (isset($$item)) {
                $value = $$item;
                $label = ucwords(str_replace('_', ' ', $item));
                $html .= "<li><b>$label: </b>";
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                $html .= "$value</li>";
                $text .= "$label: $value\r\n";
            }
        }

// complete the HTML content
        $html .= '</ul></td></tr>';
        $html .= '</table></body></html>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}