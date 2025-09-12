<?php
// Load configuration first
require_once 'conf.php';

// Define autoload directories
$directories = ["forms", "layout", "global", "mail", "database"];

// Register autoloader with debugging
spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
    
    // Check if it's a PHPMailer class
    if (strpos($className, 'PHPMailer\\') === 0) {
        require 'plugins/PHPMailer/vendor/autoload.php';
        return;
    }
    
    // Debug: Log if class not found
    error_log("Class not found: $className. Searched in: " . implode(', ', $directories));
});

// Create object getters with existence checks
function getDatabase() {
    global $conf;
    static $database = null;
    
    if ($database === null && class_exists('Database')) {
        $database = new Database(
            $conf['db_host'], 
            $conf['db_user'], 
            $conf['db_pass'], 
            $conf['db_name']
        );
    }
    
    return $database;
}

function getMailHandler() {
    global $conf;
    static $mailHandler = null;
    
    if ($mailHandler === null && class_exists('MailHandler')) {
        $mailHandler = new MailHandler($conf);
    } else {
        // Debug: Log if MailHandler class doesn't exist
        if (!class_exists('MailHandler')) {
            error_log("MailHandler class does not exist. Check file location.");
        }
    }
    
    return $mailHandler;
}

function getForms() {
    static $form = null;
    
    if ($form === null && class_exists('forms')) {
        $form = new forms();
    }
    
    return $form;
}

function getLayout() {
    static $layout = null;
    
    if ($layout === null && class_exists('layout')) {
        $layout = new layout();
    }
    
    return $layout;
}

// Create global references (but don't instantiate if classes don't exist)
$database = getDatabase();
$mailHandler = getMailHandler(); // This is line 29 that's causing the error
$form = getForms();
$layout = getLayout();
?>