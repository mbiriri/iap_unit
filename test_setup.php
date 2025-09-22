<?php
require_once 'ClassAutoLoad.php';

echo "<h2>System Setup Test</h2>";

// Test database connection
if ($database) {
    echo "✅ Database connection: OK<br>";
    
    // Test if users table exists
    $result = $database->getUsers();
    if (is_array($result)) {
        echo "✅ Users table: OK<br>";
    } else {
        echo "❌ Users table: Not accessible<br>";
    }
} else {
    echo "❌ Database connection: FAILED<br>";
}

// Test mail handler
if ($mailHandler) {
    echo "✅ MailHandler: OK<br>";
    
    // Test email validation
    $testEmail = 'test@example.com';
    $isValid = $mailHandler->validateEmail($testEmail);
    echo "✅ Email validation: " . ($isValid ? 'PASS' : 'FAIL') . "<br>";
} else {
    echo "❌ MailHandler: Not available<br>";
}

// Test send mail
if ($ObjSendMail) {
    echo "✅ SendMail: OK<br>";
} else {
    echo "❌ SendMail: Not available<br>";
}

// Test other objects
echo "✅ Forms: " . ($ObjForms ? 'OK' : 'Not available') . "<br>";
echo "✅ Layout: " . ($ObjLayout ? 'OK' : 'Not available') . "<br>";
echo "✅ Functions: " . ($ObjFncs ? 'OK' : 'Not available') . "<br>";
echo "✅ Auth: " . ($ObjAuth ? 'OK' : 'Not available') . "<br>";

echo "<p><a href='index.php'>Go to main application</a></p>";
?><?php