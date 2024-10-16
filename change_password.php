<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar.php'); ?>

<?php
// Connect to the database
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current user's details
$query = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$query->bind_param("s", $session_id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
?>

<div class="container">
    <div class="margin-top">
        <div class="row">
            <?php include('head.php'); ?>
            <div class="span3"></div>
            <div class="span7">
                <form class="form-horizontal" method="post">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">New Password</label>
                        <div class="controls">
                            <input type="password" name="np" id="inputEmail" placeholder="New Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Re-type Password</label>
                        <div class="controls">
                            <input type="password" name="rp" id="inputPassword" placeholder="Re-type Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php
                    if (isset($_POST['update'])) {
                        $np = $_POST['np'];
                        $rp = $_POST['rp'];

                        if ($np != $rp) {
                            echo '<div class="alert alert-danger">Passwords do not match</div>';
                        } else {
                            // Update password securely using prepared statement
                            $update_query = $conn->prepare("UPDATE students SET password = ? WHERE student_id = ?");
                            $update_query->bind_param("ss", $np, $session_id);
                            if ($update_query->execute()) {
                                echo '<div class="alert alert-success">Password changed successfully</div>';
                            } else {
                                echo '<div class="alert alert-danger">Error updating password</div>';
                            }
                            $update_query->close();
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Close the connection
$conn->close();
?>

<?php include('footer.php'); ?>
