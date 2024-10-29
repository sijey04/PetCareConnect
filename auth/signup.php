<?php
session_start();
require_once '../classes/authController.php';

$auth = new AuthController();
$error = '';
$success = '';

if (isset($_SESSION['user_id'])) {
    header("Location: ../NA-Index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);

    $result = $auth->signup($email, $password, $confirm_password, $first_name, $last_name);
    
    if (!empty($result['error'])) {
        $error = $result['error'];
    } else {
        $success = $result['success'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
        <title>Sign Up - Pet Care Connect</title>
        <link href="../dist/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .password-strength-meter {
            height: 4px;
            background-color: #ddd;
            border-radius: 2px;
            margin-top: 5px;
        }

        #password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease-in-out, background-color 0.3s ease-in-out;
            border-radius: 2px;
        }
    </style>

</head>

<body class="flex flex-col lg:flex-row min-h-screen bg-custom-bg font-[Poppins]">
    <!-- Image container for desktop only -->
    <div class="hidden lg:flex flex-1 relative overflow-hidden bg-custom-bg min-h-screen items-center justify-center order-1 lg:order-2">
        <div class="absolute top-4 right-4 z-20">
            <a href="../NA-Index.php">
                <img src="../images/logo.png" alt="Pet Care Connect Logo" class="w-32 md:w-48">
            </a>
        </div>
        <div class="relative w-full h-full flex items-center justify-center pr-24 md:pr-32 lg:pr-40 pb-12 md:pb-20 lg:pb-">
            <img src="../images/kitten2.png" alt="Cute kitten" class="relative z-10 w-[400px] md:w-[600px] lg:w-[700px] xl:w-[800px] object-contain mr-12 md:mr-20 lg:mr-28">
        </div>
    </div>
    
    <!-- Sign up form container -->
    <div class="flex-1 flex items-center justify-center bg-custom-bg p-4 lg:p-8 order-2 lg:order-1">
        <div class="w-full max-w-md space-y-8 px-4 sm:px-8 py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
            <div class="text-center">
                <h2 class="text-1xl sm:text-3xl font-bold">Get Started With</h2>
                <a href="../NA-Index.php">
                    <img src="../images/logo.png" alt="Pet Care Connect Logo" class="w-24 sm:w-32 mx-auto mt-2">
                </a>
                <p class="text-gray-600 mt-2 text-sm sm:text-base">Getting started is easy</p>
            </div>
            
            <!-- Error and success messages -->
            <?php if (!empty($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
                </div>
            <?php endif; ?>

            <!-- Social login buttons -->
            <div class="flex space-x-4">
                <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="../images/icons/google-logo.png" alt="Google logo" class="w-4 h-4 sm:w-5 sm:h-5 mr-2">
                    Google
                </button>
                <button class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="../images/icons/facebook-logo.png" alt="Facebook logo" class="w-4 h-4 sm:w-5 sm:h-5 mr-2">
                    Facebook
                </button>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-gray-300"></span>
                </div>
                <div class="relative flex justify-center text-xs sm:text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <!-- Sign up form -->
            <form class="space-y-4 sm:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <input type="text" name="first_name" placeholder="First Name" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                </div>
                <div>
                    <input type="text" name="last_name" placeholder="Last Name" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                </div>
                <div>
                    <input type="email" name="email" placeholder="Enter Email" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                </div>
                <div class="relative" x-data="{ 
                    showPassword: false,
                    password: '',
                    strength: 0,
                    strengthColor() {
                        if (this.strength < 25) return '#dc2626'; // red
                        if (this.strength < 50) return '#f59e0b'; // yellow
                        if (this.strength < 75) return '#10b981'; // green
                        return '#059669'; // dark green
                    },
                    calculateStrength() {
                        let score = 0;
                        // Length check
                        if (this.password.length >= 8) score += 25;
                        // Special character check
                        if (/[^A-Za-z0-9]/.test(this.password)) score += 25;
                        // Number check
                        if (/[0-9]/.test(this.password)) score += 25;
                        // Uppercase and lowercase check
                        if (/[A-Z]/.test(this.password) && /[a-z]/.test(this.password)) score += 25;
                        this.strength = score;
                    }
                }">
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        id="password" 
                        placeholder="Password" 
                        required 
                        x-model="password"
                        @input="calculateStrength()"
                        class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue"
                    >
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    >
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="password-strength-meter mt-1">
                        <div id="password-strength-bar" 
                             :style="`width: ${strength}%; background-color: ${strengthColor()}`">
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        <span :class="{'text-green-600': strength >= 25}">✓ At least 8 characters</span><br>
                        <span :class="{'text-green-600': /[^A-Za-z0-9]/.test(password)}">✓ Special character</span><br>
                        <span :class="{'text-green-600': /[0-9]/.test(password)}">✓ Number</span><br>
                        <span :class="{'text-green-600': /[A-Z]/.test(password) && /[a-z]/.test(password)}">✓ Upper & lowercase</span>
                    </p>
                </div>
                <div class="relative">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-custom-blue focus:border-custom-blue">
                    <button type="button" onclick="togglePassword('confirm_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">Password must be at least 8 characters long and contain a special character.</p>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-custom-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-blue">
                    Create Account
                </button>
            </form>
            <p class="text-center text-xs sm:text-sm text-gray-600">
                Have an account?
                <a href="../auth/login.php" class="text-custom-blue hover:underline">
                    Sign in!
                </a>
            </p>
        </div>
    </div>

</body>
</html>
