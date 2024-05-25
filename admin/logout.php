<?php
session_start(); // Access the session

// Clear all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

header("Location: ../index.html"); // Redirect to login page
exit;
?>
