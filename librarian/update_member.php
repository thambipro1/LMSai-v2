<?php 
include('dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $type = $_POST['type'];
    $year_level = $_POST['year_level'];
    $status = $_POST['status'];

    // Update member details
    $update_query = "
        UPDATE member 
        SET 
            firstname = '$firstname',
            lastname = '$lastname',
            gender = '$gender',
            address = '$address',
            contact = '$contact',
            type = '$type',
            year_level = '$year_level',
            status = '$status' 
        WHERE 
            member_id = '$id'
    ";

    if (mysqli_query($db, $update_query)) {
        header('location:member.php');
    } else {
        die("Error updating record: " . mysqli_error($db));
    }
}
?>
