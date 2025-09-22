<?php

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set('Africa/Nairobi');

// Set base URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';

// Site Information
$conf['site_name'] = 'ICS Community';
$conf['site_initials'] = 'icsc';
$conf['site_domain'] = 'icscommunity.com';
$conf['site_slogan'] = 'A Place of Connection';
$conf['site_url'] = $base_url . 'iap_unit/'; // Fixed this line
$conf['site_title'] = $conf['site_name'] . ' - ' . $conf['site_slogan'];
$conf['site_desc'] = 'Join ' . $conf['site_name'] . ' to provide a place of connection.';
$conf['site_authors'] = ['Alex Okama', $conf['site_name']];
$conf['site_email'] = 'admin@' . $conf['site_domain'];
$conf['admin_email'] = 'mbiririjoyce6@gmail.com'; // Add this line
$conf['version'] = 'v1.0.0';

// Database Configuration
$conf['db_type'] = 'mysqli';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = 'maria123#';
$conf['db_name'] = 'iap_unit';

// Site Language
$conf['site_lang'] = 'en';

// email configuration
$conf['mail_type'] = 'smtp'; // mail or smtp
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'mbiririjoyce6@gmail.com';
$conf['smtp_pass'] = 'klqz kmmk albu gjrm';
$conf['smtp_port'] = 465; // 587 or 465
$conf['smtp_secure'] = 'ssl'; // tls or ssl
$conf['mail_from'] = 'no-reply@' . $conf['site_domain'];
$conf['mail_from_name'] = $conf['site_name'] . ' Team';

// Valid password length
$conf['min_password_length'] = 4;

// Valid email domains
$conf['valid_email_domains'] = [$conf['site_domain'], 'gmail.com', 'yahoo.com', 'outlook.com', 'strathmore.edu'];

// Set verification code
$conf['verification_code'] = rand(100000, 999999); // Example: 6-digit code