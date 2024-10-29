<?php
session_start();
require_once '../classes/authController.php';

$auth = new AuthController();
$error = '';

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']) ? true : false;

    $result = $auth->login($email, $password, $remember_me);
    
    if ($result['success']) {
        header("Location: ../index.php");
        exit();
    } else {
        $error = $result['error'];
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

// Add this near the top of the file
function debug_file_exists($path) {
    if (!file_exists($path)) {
        error_log("File not found: " . realpath(dirname(__FILE__)) . "/$path");
        return false;
    }
    return true;
}

// Check all required files
$required_files = [
    '../images/logo.png',
    '../images/kitten.png',
    '../images/icons/google-logo.png',
    '../images/icons/facebook-logo.png',
    '../dist/css/styles.css'
];

foreach ($required_files as $file) {
    debug_file_exists($file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>Login - Pet Care Connect</title>
    <link href="../dist/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col lg:flex-row min-h-screen bg-custom-bg font-[Poppins]" x-data="{ showPassword: false }">
    <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-[50vh] lg:min-h-screen items-center justify-center">
        <div class="absolute top-4 left-4 z-20">
            <a href="../NA-Index.php">
                <?php 
                $logoPath = "../images/logo.png";
                if (!file_exists($logoPath)) {
                    echo "<!-- Logo file not found at: $logoPath -->";
                }
                ?>
                <img src="<?php echo $logoPath; ?>" alt="Pet Care Connect Logo" class="w-32 md:w-48" onerror="this.style.display='none'; console.log('Logo failed to load');">
            </a>
        </div>
        <div class="relative w-full h-full flex items-center justify-center pl-24 md:pl-32 lg:pl-40 pb-16 md:pb-24 lg:pb-32">
            <?php 
            $kittenPath = "../images/kitten.png";
            if (!file_exists($kittenPath)) {
                echo "<!-- Kitten image not found at: $kittenPath -->";
            }
            ?>
            <img src="<?php echo $kittenPath; ?>" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain ml-16 md:ml-24 lg:ml-32" onerror="this.style.display='none'; console.log('Kitten image failed to load');">
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
                    <?php 
                    $googleLogoPath = "../images/icons/google-logo.png";
                    if (!file_exists($googleLogoPath)) {
                        echo "<!-- Google logo not found at: $googleLogoPath -->";
                    }
                    ?>
                    <img src="<?php echo $googleLogoPath; ?>" alt="Google logo" class="w-5 h-5 mr-2" onerror="this.style.display='none';">
                    Google
                </button>
                <button onclick="loginWithFacebook()" class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <?php 
                    $fbLogoPath = "../images/icons/facebook-logo.png";
                    if (!file_exists($fbLogoPath)) {
                        echo "<!-- Facebook logo not found at: $fbLogoPath -->";
                    }
                    ?>
                    <img src="<?php echo $fbLogoPath; ?>" alt="Facebook logo" class="w-5 h-5 mr-2" onerror="this.style.display='none';">
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
                <div class="relative" x-data="passwordVisibility">
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        id="password" 
                        placeholder="Password" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                    >
                    <button 
                        type="button" 
                        @click="togglePassword()" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    >
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
        function passwordVisibility() {
            return {
                showPassword: false,
                togglePassword() {
                    this.showPassword = !this.showPassword;
                }
            }
        }
    </script>
</body>
</html>
