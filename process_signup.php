<?php
require_once 'ClassAutoLoad.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Simple validation
    if (empty($email) || empty($password)) {
        header('Location: signin.php?error=Please fill all fields');
        exit();
    }
    
    // Here you would normally verify credentials against database
    // For now, just redirect with success message
    header('Location: index.php?message=Login successful');
    exit();
} else {
    header('Location: signin.php');
    exit();
}
?>