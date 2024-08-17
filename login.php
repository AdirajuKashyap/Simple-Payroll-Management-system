<?php
// Start the session
session_start();

// Define user IDs and passwords
$users = array(
    'user1' => '1234',
    'user2' => '5678',
    // Add more users as needed
);

// Check if the submitted username exists in the array and if the password matches
if (isset($_POST['Userid']) && isset($_POST['password']) && isset($users[$_POST['Userid']]) && $users[$_POST['Userid']] == $_POST['password']) {
    // Set session variable to indicate user is logged in
    $_SESSION['logged_in'] = true;
    // Redirect user to home page
    header('Location: home.html');
    exit;
} else {
    // If username or password is incorrect, redirect back to login page with error message
    header('Location: index.html?error=1');
    exit;
}
?>
