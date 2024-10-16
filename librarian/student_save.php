<?php 
include('dbcon.php');
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $type = $_POST['type'];
    $year_level = $_POST['year_level'];

    // Prepare the SQL query
    $query = "INSERT INTO member (firstname, lastname, gender, address, contact, type, year_level) 
              VALUES ('$firstname', '$lastname', '$gender', '$address', '$contact', '$type', '$year_level')";

    // Execute the query and check for errors
    if (mysqli_query($db, $query)) {
        header('Location: member.php');
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
