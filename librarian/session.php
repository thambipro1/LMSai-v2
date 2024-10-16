<?php
// Start the session
session_start();

// Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id']) || empty(trim($_SESSION['id']))) {
    // Redirect to the login page if the session ID is not set or is empty
    header("Location: index.php");
    exit(); // Always call exit after a header redirect to stop script execution
}

// Store the session ID in a variable for later use
$session_id = $_SESSION['id'];
?>
