<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #f4f6f9;
            height: 100vh; /* Use full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* Add padding to prevent overflow on smaller screens */
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 50px 40px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%; /* Use full width */
            animation: fadeIn 0.8s ease-out;
            text-align: center;
            margin-left: 375px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #5e9cf7;
            outline: none;
            box-shadow: 0 0 10px rgba(94, 156, 247, 0.2);
        }

        input[type="file"] {
            display: none;
        }

        .file-upload-wrapper {
            background-color: #f8f9fa;
            padding: 14px;
            border: 1px dashed #ccc;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
        }

        .file-upload-wrapper span {
            color: #777;
        }

        .form-group.file-upload-wrapper:hover {
            border-color: #5e9cf7;
            background-color: #f1f5fe;
        }

        .btn {
            background-color: #5e9cf7;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 14px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #4b89e6;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .confirmation-message {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

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

// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $image = $_FILES['image'];

    // Error handling
    if (empty($student_no)) {
        $errors['student_no'] = "Student number is required.";
    }

    if ($password !== $cpassword) {
        $errors['password'] = "Passwords do not match.";
    }

    if ($image['error'] != 0) {
        $errors['image'] = "Please upload an image.";
    }

    if (empty($errors)) {
        // Check for duplicate student_no
        $stmt = $db->prepare("SELECT COUNT(*) FROM students WHERE student_no = ?");
        $stmt->bind_param("s", $student_no);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $errors['duplicate'] = "User already exists with this Student No.";
        } else {
            // Image upload handling
            $target_dir = "uploads/";
            $image_name = basename($image["name"]);
            $target_file = $target_dir . $image_name;

            // Ensure the uploads directory exists
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            move_uploaded_file($image["tmp_name"], $target_file);

            // Insert into the database
            $stmt = $db->prepare("INSERT INTO students (student_no, password, photo) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $student_no, $password, $target_file);

            if ($stmt->execute()) {
                echo "<div class='confirmation-message'>Registration successful! Welcome to LMSai.</div>";
            } else {
                echo "<div class='error'>Registration failed: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }
    }
    $db->close();
}
?>

    <div class="form-container" id="registrationForm">
        <h2>Student Registration</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="student_no">Student No:</label>
                <input type="text" id="student_no" name="student_no" placeholder="Enter Student No" required>
                <?php if (!empty($errors['student_no'])) echo "<span class='error'>" . $errors['student_no'] . "</span>"; ?>
                <?php if (!empty($errors['duplicate'])) echo "<span class='error'>" . $errors['duplicate'] . "</span>"; ?>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                <?php if (!empty($errors['password'])) echo "<span class='error'>" . $errors['password'] . "</span>"; ?>
            </div>

            <div class="form-group file-upload-wrapper">
                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image" required>
                <span>Click to choose file</span>
                <?php if (!empty($errors['image'])) echo "<span class='error'>" . $errors['image'] . "</span>"; ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Confirm</button>
            </div>
        </form>
    </div>

</body>
</html>
