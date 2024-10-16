<?php 
include('dbcon.php'); // Assuming dbcon.php contains the connection setup using $db

if (isset($_POST['submit'])) {
    $book_title = $_POST['book_title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $book_copies = $_POST['book_copies'];
    $book_pub = $_POST['book_pub'];
    $publisher_name = $_POST['publisher_name'];
    $isbn = $_POST['isbn'];
    $copyright_year = $_POST['copyright_year'];
    $status = $_POST['status'];

    // Handle image upload
    $targetDir = "uploads/"; // Ensure this directory exists and is writable
    $fileName = basename($_FILES["book_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["book_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (optional, e.g., 5MB limit)
    if ($_FILES["book_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if everything is OK before uploading
    if ($uploadOk == 1) {
        // Move the file to the target directory
        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $targetFilePath)) {
            // Prepare an SQL statement to prevent SQL injection
            $stmt = $db->prepare("INSERT INTO book (book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_added, status, book_image) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");

            // Bind parameters to the SQL query
            $stmt->bind_param('sisissssss', $book_title, $category_id, $author, $book_copies, $book_pub, $publisher_name, $isbn, $copyright_year, $status, $targetFilePath);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to books page on success
                header('location:books.php');
            } else {
                // Handle error if query fails
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }

    // Close the database connection
    $db->close();
}
?>
