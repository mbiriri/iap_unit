<?php
class auth {
    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }
    
    public function signup($conf, $ObjFncs, $ObjSendMail = null) {
        // code for signup
        if(isset($_POST['signup'])) {
            $errors = [];
            $fullname = $_SESSION['fullname'] = ucwords(strtolower($_POST['fullname']));
            $email = $_SESSION['email'] = strtolower($_POST['email']);
            $password = $_SESSION['password'] = $_POST['password'];
            
            // Validation
            if (!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
                $errors['nameFormat_error'] = "Only letters and white space allowed in fullname";
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['mailFormat_error'] = "Invalid email format";
            }

            $emailDomain = substr(strrchr($email, "@"), 1);
            if (!in_array($emailDomain, $conf['valid_email_domains'])) {
                $errors['emailDomain_error'] = "Invalid email domain";
            }

            if (strlen($password) < $conf['min_password_length']) {
                $errors['passwordLength_error'] = "Password must be at least " . $conf['min_password_length'] . " characters long";
            }

            if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).+$/", $password)) {
                $errors['passwordComplexity_error'] = "Password must contain at least one letter and one number";
            }

            if (!count($errors)) {
                // Save user to database
                $userSaved = $this->database->saveUser($fullname, $email, $password);
                
                if ($userSaved) {
                    // Send welcome email if mail handler is available
                    if ($ObjSendMail) {
                        // You might need to adapt this to use your sendMail class
                        // For now, we'll just log that we would send an email
                        error_log("Would send welcome email to: $email");
                    }
                    
                    // Clear session data
                    unset($_SESSION['fullname']);
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);
                    
                    $ObjFncs->setMsg('msg', 'Sign up successful. You can now log in.', 'success');
                } else {
                    $ObjFncs->setMsg('errors', ['database_error' => 'Username or email already exists'], 'danger');
                    $ObjFncs->setMsg('msg', 'Please fix the errors below and try again.', 'danger');
                }
            } else {
                $ObjFncs->setMsg('errors', $errors, 'danger');
                $ObjFncs->setMsg('msg', 'Please fix the errors below and try again.', 'danger');
            }
        }
    }
}
?><?php