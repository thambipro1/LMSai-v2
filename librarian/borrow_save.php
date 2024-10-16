<?php
include('dbcon.php'); // Assuming dbcon.php contains your MySQLi connection code

$id = $_POST['selector'] ?? [];
$member_id = $_POST['member_id'] ?? '';
$due_date = $_POST['due_date'] ?? '';

// Check if no book IDs were selected
if (empty($id) || empty($member_id) || empty($due_date)) {
    header("location: borrow.php");
    exit; // Ensure script stops executing after redirect
} else {
    // Prepare and execute the borrow insertion
    $stmt = $db->prepare("INSERT INTO borrow (member_id, date_borrow, due_date) VALUES (?, NOW(), ?)");
    $stmt->bind_param("is", $member_id, $due_date); // 'i' for integer, 's' for string

    if ($stmt->execute()) {
        // Get the last inserted borrow ID
        $borrow_id = $stmt->insert_id;

        // Prepare borrow details insertion
        $details_stmt = $db->prepare("INSERT INTO borrowdetails (book_id, borrow_id, borrow_status) VALUES (?, ?, 'pending')");

        foreach ($id as $book_id) {
            $details_stmt->bind_param("ii", $book_id, $borrow_id);
            $details_stmt->execute();
        }

        // Close the borrow details statement
        $details_stmt->close();
    } else {
        // Handle error if borrow insertion fails
        echo "Error: " . $stmt->error;
    }

    // Close the borrow statement
    $stmt->close();
    // Close the database connection
    $db->close();
    
    header("location: borrow.php");
    exit; // Ensure script stops executing after redirect
}
?>
