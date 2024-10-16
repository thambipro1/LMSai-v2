<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $book_title = $_POST['book_title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $book_copies = $_POST['book_copies'];
    $book_pub = $_POST['book_pub'];
    $publisher_name = $_POST['publisher_name'];
    $isbn = $_POST['isbn'];
    $copyright_year = $_POST['copyright_year'];
    $status = $_POST['status'];

    // Update book details
    $update_query = "
        UPDATE book 
        SET 
            book_title = '$book_title',
            category_id = '$category_id',
            author = '$author',
            book_copies = '$book_copies',
            book_pub = '$book_pub',
            publisher_name = '$publisher_name',
            isbn = '$isbn',
            copyright_year = '$copyright_year',
            status = '$status' 
        WHERE 
            book_id = '$id'
    ";

    if (mysqli_query($db, $update_query)) {
        header('location:books.php');
    } else {
        die("Error updating record: " . mysqli_error($db));
    }
}
?>
