<?php
// Load configuration first
require_once 'conf.php';

// Define autoload directories
$directories = ["forms", "layout", "global", "mail", "database", "proc"];

// Register autoloader with debugging
spl_autoload_register(function ($className) use ($directories) {
    // Convert className to match filename convention (sendMail -> sendMail.php)
    $className = str_replace('\\', '/', $className);
    
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
    
    // Check if it's a PHPMailer class
    if (strpos($className, 'PHPMailer') === 0) {
        $phpmailerPath = __DIR__ . '/plugins/PHPMailer/vendor/autoload.php';
        if (file_exists($phpmailerPath)) {
            require_once $phpmailerPath;
            return;
        }
    }
    
    // Debug: Log if class not found
    error_log("Class not found: $className. Searched in: " . implode(', ', $directories));
});

// Create object getters with existence checks
function getDatabase() {
    global $conf;
    static $database = null;
    
    if ($database === null && class_exists('Database')) {
        try {
            $database = new Database(
                $conf['db_host'], 
                $conf['db_user'], 
                $conf['db_pass'], 
                $conf['db_name']
            );
        } catch (Exception $e) {
            error_log("Database connection failed: " . $e->getMessage());
            $database = false;
        }
    }
    
    return $database;
}

function getMailHandler() {
    global $conf;
    static $mailHandler = null;
    
    if ($mailHandler === null && class_exists('MailHandler')) {
        $mailHandler = new MailHandler($conf);
    }
    
    return $mailHandler;
}

function getSendMail() {
    global $conf;
    static $sendMail = null;
    
    if ($sendMail === null && class_exists('sendMail')) {
        $sendMail = new sendMail();
    }
    
    return $sendMail;
}

// Create global references
$database = getDatabase();
$mailHandler = getMailHandler();
$ObjSendMail = getSendMail();

// Only instantiate these if the classes exist
$ObjForms = class_exists('forms') ? new forms() : null;
$ObjLayout = class_exists('layout') ? new layout() : null;
$ObjFncs = class_exists('fncs') ? new fncs() : null;

// Initialize auth only if database exists
$ObjAuth = null;
if (class_exists('auth') && $database) {
    $ObjAuth = new auth($database);
    
    // Only call signup if we have all required dependencies
    if ($ObjAuth && $ObjFncs && $ObjSendMail) {
        $ObjAuth->signup($conf, $ObjFncs, $ObjSendMail);
    }
}

// Create aliases for consistency (some scripts use different variable names)
$OBJLayout = $ObjLayout;
$OBJsendMail = $ObjSendMail;
?>