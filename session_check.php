<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Check if the session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['expire_time'])) {
    // Session has expired, destroy the session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
