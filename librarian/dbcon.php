<?php
// dbcon.php
$host = 'localhost';
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password
$dbname = 'eb_lms';

$db = new mysqli($host, $user, $pass, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
