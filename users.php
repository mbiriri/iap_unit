<?php
require_once 'ClassAutoLoad.php';

$layout->header($conf);

echo "<div style='padding: 20px;'>";
echo "<h2>Registered Users</h2>";

// Get users from database
$users = $database->getUsers();

if (!empty($users)) {
    echo "<ol>";
    $count = 1;
    foreach ($users as $user) {
        $created = date('M j, Y', strtotime($user['created_at']));
        echo "<li>
                <strong>" . htmlspecialchars($user['username']) . "</strong> 
                (" . htmlspecialchars($user['email']) . ")
                <small> - joined: $created</small>
              </li>";
        $count++;
    }
    echo "</ol>";
    
    echo "<p>Total users: " . count($users) . "</p>";
} else {
    echo "<p>No users registered yet.</p>";
}

echo "<p><a href='index.php'>Back to registration</a></p>";

// Add a simple form to test with
echo "<div style='margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;'>
        <h3>Quick Test Registration</h3>
        <form method='post' action='process_signup.php' style='display: grid; gap: 10px; max-width: 400px;'>
            <input type='text' name='username' placeholder='Username' required>
            <input type='email' name='email' placeholder='Email' required>
            <input type='password' name='password' placeholder='Password' required>
            <button type='submit'>Register Test User</button>
        </form>
      </div>";

echo "</div>";

$layout->footer($conf);
?>