<?php 
ob_start(); // Start output buffering
session_start(); // Start the session at the very top

include('header.php'); 
include('navbar.php'); 
?>
<div class="container" style="margin-top: 50px; max-width: 500px; animation: fadeIn 1s;">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="../LMS/headerLMSai.gif" alt="Header Image" style="width: 100%; border-radius: 10px;">
    </div>
    <div style="background-color: #f8f9fa; border-radius: 10px; padding: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: fadeIn 1.5s;">
        <p style="font-size: 1.2em; font-weight: bold; text-align: center; color: #333;">Please Enter the Details Below..</p>
        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; font-weight: bold; color: #555;">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; font-weight: bold; color: #555;">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
            </div>
            <div style="text-align: center;">
                <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; font-size: 1em; cursor: pointer; transition: background-color 0.3s;">
                    Submit
                </button>
            </div>
        </form>

        <?php
        // Database connection parameters
        $servername = "localhost";
        $dbUsername = "root"; // Replace with your database username
        $dbPassword = ""; // Replace with your database password
        $database = "eb_lms";

        // Create a connection
        $db = new mysqli($servername, $dbUsername, $dbPassword, $database);

        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Retrieve the username and password from POST
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare the SQL statement to prevent SQL injection
            $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any rows are returned
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['user_id'];
                header('Location: dashboard.php');
                exit();
            } else {
                echo '<div style="margin-top: 15px; text-align: center; color: red;">Access Denied: Invalid username or password</div>';
            }

            // Close connections
            $stmt->close();
            $db->close();
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?> 
<?php ob_end_flush(); // Flush the output buffer ?>

<!-- Inline Styles for Animations -->
<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
button:hover {
    background-color: #0056b3;
}
</style>
