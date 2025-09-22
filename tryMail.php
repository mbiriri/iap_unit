<?php
require_once 'ClassAutoLoad.php';

// Check if mail handler exists
if (!$ObjSendMail) {
    die("Mail handler is not available. Please check your configuration.");
}

$mailcontent = [
    'name_from' => 'ICS community',
    'email_from' => 'no-reply@ics-community.com',
    'name_to' => 'strathmore student',
    'email_to' => 'strath@gmail.com',
    'subject' => 'Test email from ICS Community',
    'body' => 'This is a test email to check if the email configuration is working fine. Thank you.',
];

$ObjSendMail->send_Mail($conf, $mailcontent);

echo "Email sent attempt completed. Check your email and server logs for results.";
?><?php