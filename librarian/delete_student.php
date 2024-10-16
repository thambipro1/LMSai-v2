<?php
include('dbcon.php'); // Ensure dbcon.php establishes a connection using mysqli

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate that the ID is a number
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("Error: Invalid ID.");
    }

    // Prepare the SQL statement to delete the member
    $stmt = $db->prepare("DELETE FROM member WHERE member_id = ?");
    
    // Bind the parameter
    $stmt->bind_param("i", $id); // Assuming member_id is an integer

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to the members page on success
        header('Location: member.php');
        exit(); // Stop further script execution
    } else {
        // Handle any errors during execution
        die("Error deleting record: " . $stmt->error);
    }

} else {
    die("Error: ID not specified.");
}
