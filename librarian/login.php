<?php
session_start(); // Start the session at the beginning

if (isset($_POST['submit'])) {
    // Database connection parameters
    $servername = "localhost";
    $dbUsername = "root"; // Replace with your database username
    $dbPassword = ""; // Replace with your database password
    $database = "eb_lms";

    // Create a connection
    $db = new mysqli($servername, $dbUsername, $dbPassword, $database);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Retrieve the username and password from POST
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['user_id'];
        header('Location: dashboard.php');
        exit(); // Always use exit after a header redirect
    } else {
        echo '<div class="alert alert-danger">Access Denied</div>';
    }

    // Close connections
    $stmt->close();
    $db->close();
}
?>
