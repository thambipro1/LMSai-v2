<?php 
include('dbcon.php'); // Include the database connection file

if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $type = $_POST['type'];
    $year_level = $_POST['year_level'];

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO member (firstname, lastname, gender, address, contact, type, year_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters to the SQL query
    $stmt->bind_param("sssssss", $firstname, $lastname, $gender, $address, $contact, $type, $year_level);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the member page upon success
        header('Location: member.php');
        exit(); // Always use exit after a header redirect
    } else {
        // Display an error message if the query fails
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    // Close the statement and database connection
    $stmt->close();
    $db->close();
}
?>
