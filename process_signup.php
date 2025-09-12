<?php
require_once 'ClassAutoLoad.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $errors = [];
    
    // Validate email using MailHandler
    if (!$mailHandler->validateEmail($email)) {
        $errors[] = "Please enter a valid email address.";
    }
    
    // Validate other fields
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    
    if (empty($errors)) {
        // Save user to database
        $userSaved = $database->saveUser($username, $email, $password);
        
        if ($userSaved) {
            // Send welcome email
            $emailSent = $mailHandler->sendWelcomeEmail($email, $username);
            
            if ($emailSent) {
                // Success message
                $layout->header($conf);
                echo "<div style='padding: 20px; background-color: #d4edda; color: #155724; border-radius: 5px; margin: 20px;'>
                        <h3>Registration Successful!</h3>
                        <p>A welcome email has been sent to <strong>$email</strong>.</p>
                        <p>Redirecting to users list in 5 seconds...</p>
                      </div>";
                $layout->footer($conf);
                
                // Redirect to users list after delay
                header('Refresh: 5; URL=users.php');
            } else {
                $layout->header($conf);
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin: 20px;'>
                        <h3>Registration Successful!</h3>
                        <p>However, we couldn't send the welcome email. Please try again later.</p>
                        <p><a href='users.php'>View all users</a></p>
                      </div>";
                $layout->footer($conf);
            }
        } else {
            $layout->header($conf);
            echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin: 20px;'>
                    <h3>Error</h3>
                    <p>Username or email already exists. Please choose different credentials.</p>
                    <p><a href='index.php'>Try again</a></p>
                  </div>";
            $layout->footer($conf);
        }
    } else {
        // Redisplay form with errors
        $layout->header($conf);
        echo "<div style='padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin: 20px;'>";
        echo "<h3>Please correct the following errors:</h3>";
        foreach ($errors as $error) {
            echo "<p>- $error</p>";
        }
        echo "</div>";
        $form->signup();
        $layout->footer($conf);
    }
} else {
    header('Location: index.php');
    exit();
}
?>