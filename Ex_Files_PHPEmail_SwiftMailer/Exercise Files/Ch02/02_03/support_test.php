<?php
/*
 * The Swift_SmtpTransport and Swift_SendmailTransport classes
 * use program execution functions that are disabled on some
 * servers. This short test confirms whether they are supported
 * on your server.
 *
 * If the test fails, you need to get your hosting company or
 * server administrator to enable proc_open() and all
 * functions that begin with proc_. Otherwise, the only Swift
 * Mailer transport that you can use is Swift_MailTransport.
 */
echo function_exists('proc_open') ? 'Success' : 'Fail';