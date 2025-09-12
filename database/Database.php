<?php
class Database {
    private $connection;
    
    public function __construct($host, $user, $pass, $dbname) {
        $this->connection = new mysqli($host, $user, $pass, $dbname);
        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    public function getUsers() {
        $query = "SELECT id, username, email, created_at FROM users ORDER BY username ASC";
        $result = $this->connection->query($query);
        
        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        return $users;
    }
    
    public function saveUser($username, $email, $password) {
        // Check if user already exists
        if ($this->userExists($username, $email)) {
            return false;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        
        return $stmt->execute();
    }
    
    private function userExists($username, $email) {
        $query = "SELECT id FROM users WHERE username = ? OR email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows > 0;
    }
    
    public function close() {
        $this->connection->close();
    }
}
?>