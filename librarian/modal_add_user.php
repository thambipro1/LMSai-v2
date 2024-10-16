<div id="add_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add User</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Username</label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                    <input type="password" name="password" id="inputPassword" placeholder="Password" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFirstname">Firstname</label>
                <div class="controls">
                    <input type="text" id="inputFirstname" name="firstname" placeholder="Firstname" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLastname">Lastname</label>
                <div class="controls">
                    <input type="text" id="inputLastname" name="lastname" placeholder="Lastname" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Include the database connection
    include('dbcon.php'); // Ensure this file connects to your database

    // Get the input values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Prepare the SQL statement to insert user data
    $stmt = $db->prepare("INSERT INTO users (username, password, firstname, lastname) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $firstname, $lastname);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">User added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error adding user: ' . htmlspecialchars($stmt->error) . '</div>';
    }

    // Close the statement
    $stmt->close();
}
?>
