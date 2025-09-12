<?php
// test_mailhandler.php
require_once 'ClassAutoLoad.php';

echo "<h2>Testing MailHandler</h2>";

// Check if file exists
$mailHandlerPath = __DIR__ . '/mail/MailHandler.php';
if (file_exists($mailHandlerPath)) {
    echo "✅ MailHandler.php exists at: $mailHandlerPath<br>";
    
    // Try to require it directly
    require_once $mailHandlerPath;
    
    if (class_exists('MailHandler')) {
        echo "✅ MailHandler class exists<br>";
        
        // Test instantiation
        global $conf;
        $mailHandler = new MailHandler($conf);
        echo "✅ MailHandler instantiated successfully<br>";
        
        // Test email validation
        $testEmail = 'test@example.com';
        $isValid = $mailHandler->validateEmail($testEmail);
        echo "✅ Email validation test: " . ($isValid ? 'PASS' : 'FAIL') . "<br>";
        
    } else {
        echo "❌ MailHandler class does not exist after requiring the file<br>";
    }
} else {
    echo "❌ MailHandler.php not found at: $mailHandlerPath<br>";
    echo "Please create the file in the correct location.<br>";
}

echo "<p><a href='index.php'>Go to main application</a></p>";
?>