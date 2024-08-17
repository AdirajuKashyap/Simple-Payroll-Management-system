<?php 
session_start(); // Start the session 
 
// Check if the user is logged in 
if (isset($_SESSION['user'])) { 
    // Unset all session variables 
    $_SESSION = array(); 
 
    // Destroy the session 
    session_destroy(); 
} 
 
// Redirect the user to the login page or any other desired page 
header("Location: login.php"); 
exit(); 
?> 