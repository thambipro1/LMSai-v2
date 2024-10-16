<?php
include('dbcon.php'); // Ensure this file uses mysqli for connection

$id = $_GET['id'];

// Prepare the SQL statement to avoid SQL injection
$stmt = $conn->prepare("UPDATE book SET status = 'Archive' WHERE book_id = ?");
$stmt->bind_param("i", $id); // Assuming book_id is an integer

if ($stmt->execute()) {
    header('Location: books.php');
    exit(); // Make sure to exit after header redirection
} else {
    die("Error updating record: " . $conn->error);
}
