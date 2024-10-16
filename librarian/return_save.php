<?php 
include('dbcon.php'); // Make sure this file connects to your database

// Get parameters from the URL and sanitize them
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Borrow ID
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0; // Book ID

if ($id > 0 && $book_id > 0) {
    // Prepare the SQL statement
    $stmt = $db->prepare("
        UPDATE borrow 
        LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id 
        SET borrow_status = 'returned', date_return = NOW() 
        WHERE borrow.borrow_id = ? AND borrowdetails.book_id = ?
    ");

    // Bind parameters
    $stmt->bind_param("ii", $id, $book_id); // 'ii' for integer parameters

    // Execute the statement
    if ($stmt->execute()) {
        // Successfully updated
        header('Location: view_borrow.php');
        exit();
    } else {
        // Handle execution error
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid borrow ID or book ID.";
}

// Close the database connection
$db->close();
?>
