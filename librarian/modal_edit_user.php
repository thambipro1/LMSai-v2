<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Edit User</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputUsername">Username</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>" required>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                    <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFirstname">Firstname</label>
                <div class="controls">
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLastname">Lastname</label>
                <div class="controls">
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['edit'])) {
    // Include the database connection
    include('dbcon.php'); // Ensure this file connects to your database

    // Get the input values
    $user_id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Prepare the SQL statement to update user data
    $stmt = $db->prepare("UPDATE users SET username = ?, password = ?, firstname = ?, lastname = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $username, $password, $firstname, $lastname, $user_id);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo '<script>alert("User updated successfully!"); window.location="users.php";</script>';
    } else {
        echo '<div class="alert alert-danger">Error updating user: ' . htmlspecialchars($stmt->error) . '</div>';
    }

    // Close the statement
    $stmt->close();
}
?>
