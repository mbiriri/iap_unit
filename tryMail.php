<?php
require_once 'ClassAutoLoad.php';

$mailcontent=[
    'name_from'=>'ICS c community',
    'email_from'=>'no-reply@ics-ccommunity.com',
    'name_to'=>'strathmore student',
    'email_to'=>'strath@gmail.com',
    'subject'=>'Test email from ICS C community',
    'body'=>'This is a test email to check if the email configuration is working fine. Thank you.',
];

$OBJsendMail->send_Mail($conf , $mailcontent);


?>