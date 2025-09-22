<?php
require_once 'ClassAutoLoad.php';

echo "<h2>Testing Forms</h2>";

if ($ObjForms) {
    echo "✅ Forms object: OK<br>";
    
    // Test if methods exist
    if (method_exists($ObjForms, 'signup')) {
        echo "✅ signup method: OK<br>";
    } else {
        echo "❌ signup method: Missing<br>";
    }
    
    if (method_exists($ObjForms, 'signin')) {
        echo "✅ signin method: OK<br>";
    } else {
        echo "❌ signin method: Missing<br>";
    }
} else {
    echo "❌ Forms object: Not available<br>";
}

if ($ObjLayout) {
    echo "✅ Layout object: OK<br>";
    
    if (method_exists($ObjLayout, 'form_content')) {
        echo "✅ form_content method: OK<br>";
    } else {
        echo "❌ form_content method: Missing<br>";
    }
} else {
    echo "❌ Layout object: Not available<br>";
}

echo "<p><a href='signup.php'>Test Signup Page</a></p>";
echo "<p><a href='signin.php'>Test Signin Page</a></p>";
?>