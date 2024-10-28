<?php
session_start();
require_once 'connection.php';

function validatePassword($password) {
    return (strlen($password) >= 8 && preg_match('/[^A-Za-z0-9]/', $password));
}

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

// Rate limiting
$max_attempts = 5;
$lockout_time = 15 * 60; // 15 minutes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']) ? true : false;

    if (empty($email) || empty($password)) {
        $error = "Both email and password are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $db = new Connection();
        $conn = $db->getConnection();

        // Check if login_attempts table exists, if not, create it
        try {
            $conn->query("SELECT 1 FROM login_attempts LIMIT 1");
        } catch (PDOException $e) {
            if ($e->getCode() == '42S02') {
                // Table doesn't exist, create it
                $conn->exec("CREATE TABLE login_attempts (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    attempt_time DATETIME NOT NULL
                )");
            } else {
                // Some other error occurred
                throw $e;
            }
        }

        // Check for rate limiting
        $stmt = $conn->prepare("SELECT COUNT(*) as attempt_count, MAX(attempt_time) as last_attempt FROM login_attempts WHERE email = :email AND attempt_time > DATE_SUB(NOW(), INTERVAL :lockout_time SECOND)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lockout_time', $lockout_time);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['attempt_count'] >= $max_attempts) {
            $error = "Too many failed attempts. Please try again later.";
        } else {
            $sql = "SELECT user_id, email, password_hash, user_type FROM users WHERE email = :email AND is_active = TRUE";
            
            try {
                $stmt = $conn->prepare($sql);
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
                        $_SESSION['expire_time'] = $remember_me ? 30 * 24 * 60 * 60 : 30 * 60; // 30 days or 30 minutes

                        // Clear login attempts
                        $stmt = $conn->prepare("DELETE FROM login_attempts WHERE email = :email");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        header("Location: index.php");
                        exit();
                    } else {
                        $error = "Invalid email or password.";
                        // Log failed attempt
                        $stmt = $conn->prepare("INSERT INTO login_attempts (email, attempt_time) VALUES (:email, NOW())");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                    }
                } else {
                    $error = "Invalid email or password.";
                    // Log failed attempt
                    $stmt = $conn->prepare("INSERT INTO login_attempts (email, attempt_time) VALUES (:email, NOW())");
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                }
            } catch(PDOException $e) {
                $error = "An error occurred. Please try again later.";
                error_log("Login error: " . $e->getMessage());
            }
        }
    }
}

// Check for session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['expire_time'])) {
    session_unset();
    session_destroy();
    $error = "Your session has expired. Please log in again.";
}

// Check for session expiration message
$expired_message = '';
if (isset($_GET['expired']) && $_GET['expired'] == 1) {
    $expired_message = "Your session has expired. Please log in again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Login - Pet Care Connect</title>
    <link href="dist/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col lg:flex-row min-h-screen bg-custom-bg font-[Poppins]">
    <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-[50vh] lg:min-h-screen items-center justify-center">
        <div class="absolute top-4 left-4 z-20">
            <a href="NA-Index.php">
                <img src="images/logo.png" alt="Pet Care Connect Logo" class="w-32 md:w-48">
            </a>
        </div>
        <div class="relative w-full h-full flex items-center justify-center pl-24 md:pl-32 lg:pl-40 pb-16 md:pb-24 lg:pb-32">
            <img src="images/kitten.png" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain ml-16 md:ml-24 lg:ml-32">
        </div>
    </div>
    <div class="flex-1 flex items-center justify-center bg-custom-bg p-4 lg:p-8">
        <div class="w-full max-w-md space-y-8 px-8 py-10 bg-white rounded-3xl shadow-xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold">Welcome Back!</h2>
                <p class="text-gray-600 mt-2">Login into your account</p>
            </div>
            <?php if (!empty($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($expired_message)): ?>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($expired_message); ?></span>
                </div>
            <?php endif; ?>
            <div class="flex space-x-4">
                <button onclick="loginWithGoogle()" class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="images/icons/google-logo.png" alt="Google logo" class="w-5 h-5 mr-2">
                    Google
                </button>
                <button onclick="loginWithFacebook()" class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="images/icons/facebook-logo.png" alt="Facebook logo" class="w-5 h-5 mr-2">
                    Facebook
                </button>
            </div>
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-gray-300"></span>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>
            <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <input type="email" name="email" placeholder="Email" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                </div>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember-me" name="remember_me" class="h-4 w-4 text-custom-blue focus:ring-custom-blue border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>
                    <a href="forgot_password.php" class="text-sm text-red-500 hover:underline">
                        Forgot Password?
                    </a>
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                    Log In
                </button>
            </form>
            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="signup.php" class="text-custom-blue hover:underline">
                    Sign up!
                </a>
            </p>
            <p class="text-center text-xs text-gray-500 mt-4">
                By logging in, you agree to our 
                <a href="terms.php" class="text-custom-blue hover:underline">Terms of Service</a> and 
                <a href="privacy.php" class="text-custom-blue hover:underline">Privacy Policy</a>.
            </p>
        </div>
    </div>
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function loginWithGoogle() {
            // Implement Google login
            alert('Google login not implemented yet');
        }

        function loginWithFacebook() {
            // Implement Facebook login
            alert('Facebook login not implemented yet');
        }
    </script>
</body>
</html>
