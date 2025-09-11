<?php
 require 'plugins/PHPMailer/vendor/autoload.php';
require_once 'conf.php';
$directories = ["forms", "layout", "global"];

spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

// create an instance of helloworld

$OBJsendMail = new sendMail();
$form = new forms();
$layout = new layout();