<?php
require_once 'connection.php';

class AuthController {
    private $db;
    private $conn;
    private $max_attempts = 5;
    private $lockout_time = 900; // 15 minutes in seconds

    public function __construct() {
        $this->db = new Connection();
        $this->conn = $this->db->getConnection();
        $this->initLoginAttemptsTable();
    }

    private function initLoginAttemptsTable() {
        try {
            $this->conn->query("SELECT 1 FROM login_attempts LIMIT 1");
        } catch (PDOException $e) {
            if ($e->getCode() == '42S02') {
                $this->conn->exec("CREATE TABLE login_attempts (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    attempt_time DATETIME NOT NULL
                )");
            }
        }
    }

    public function validatePassword($password) {
        return (strlen($password) >= 8 && preg_match('/[^A-Za-z0-9]/', $password));
    }

    public function signup($email, $password, $confirm_password, $first_name, $last_name) {
        $response = ['error' => '', 'success' => ''];

        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            $response['error'] = "All fields are required.";
            return $response;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'] = "Invalid email format.";
            return $response;
        }

        if (!$this->validatePassword($password)) {
            $response['error'] = "Password must be at least 8 characters long and contain a special character.";
            return $response;
        }

        if ($password !== $confirm_password) {
            $response['error'] = "Passwords do not match.";
            return $response;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user_type = 'customer';

        try {
            $sql = "INSERT INTO users (email, password_hash, first_name, last_name, user_type) 
                   VALUES (:email, :password_hash, :first_name, :last_name, :user_type)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':user_type', $user_type);

            if ($stmt->execute()) {
                $response['success'] = "Account created successfully. You can now log in.";
            } else {
                $response['error'] = "Something went wrong. Please try again.";
            }
        } catch(PDOException $e) {
            if ($e->getCode() == '23000') {
                $response['error'] = "Email already exists. Please use a different email.";
            } else {
                $response['error'] = "Database error: " . $e->getMessage();
                error_log("Signup error: " . $e->getMessage());
            }
        }

        return $response;
    }

    public function login($email, $password, $remember_me = false) {
        $response = ['error' => '', 'success' => false];

        if (empty($email) || empty($password)) {
            $response['error'] = "Both email and password are required.";
            return $response;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'] = "Invalid email format.";
            return $response;
        }

        // Check for rate limiting
        if ($this->isRateLimited($email)) {
            $response['error'] = "Too many failed attempts. Please try again later.";
            return $response;
        }

        try {
            $sql = "SELECT user_id, email, password_hash, user_type FROM users WHERE email = :email AND is_active = TRUE";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($password, $user['password_hash'])) {
                    session_regenerate_id(true);
                    
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['last_activity'] = time();
                    $_SESSION['expire_time'] = $remember_me ? 2592000 : 1800; // 30 days or 30 minutes

                    $this->clearLoginAttempts($email);
                    $response['success'] = true;
                    return $response;
                }
            }

            $this->logFailedAttempt($email);
            $response['error'] = "Invalid email or password.";
            return $response;

        } catch(PDOException $e) {
            $response['error'] = "An error occurred. Please try again later.";
            error_log("Login error: " . $e->getMessage());
            return $response;
        }
    }

    private function isRateLimited($email) {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as attempt_count 
             FROM login_attempts 
             WHERE email = :email 
             AND attempt_time > DATE_SUB(NOW(), INTERVAL :lockout_time SECOND)"
        );
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lockout_time', $this->lockout_time);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['attempt_count'] >= $this->max_attempts;
    }

    private function logFailedAttempt($email) {
        $stmt = $this->conn->prepare("INSERT INTO login_attempts (email, attempt_time) VALUES (:email, NOW())");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    private function clearLoginAttempts($email) {
        $stmt = $this->conn->prepare("DELETE FROM login_attempts WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }

    public function checkSession() {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['expire_time'])) {
            $this->logout();
            return false;
        }
        $_SESSION['last_activity'] = time();
        return true;
    }
}
