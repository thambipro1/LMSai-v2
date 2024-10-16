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

    <div class="form-container" id="registrationForm">
        <h2>Student Registration</h2>

        <div class="form-group">
            <label for="student_no">Student No:</label>
            <input type="text" id="student_no" name="student_no" placeholder="Enter Student No" required>
            <span id="studentNoError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
        </div>

        <div class="form-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
            <span id="passwordError" class="error"></span>
        </div>

        <div class="form-group file-upload-wrapper">
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image" required>
            <span>Click to choose file</span>
            <span id="imageError" class="error"></span>
        </div>

        <div class="form-group">
            <button type="button" class="btn" onclick="registerUser()">Confirm</button>
        </div>
    </div>

    <div class="confirmation-message" id="confirmationMessage">
        Registration successful! Welcome to LMSai.
    </div>

    <script>
        function registerUser() {
            // Reset error messages
            document.getElementById("studentNoError").textContent = "";
            document.getElementById("passwordError").textContent = "";
            document.getElementById("imageError").textContent = "";

            // Get form values
            const studentNo = document.getElementById("student_no").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("cpassword").value;
            const image = document.getElementById("image").files[0];

            // Error handling
            let hasError = false;

            if (studentNo === "") {
                document.getElementById("studentNoError").textContent = "Student number is required.";
                hasError = true;
            }

            if (password !== confirmPassword) {
                document.getElementById("passwordError").textContent = "Passwords do not match.";
                hasError = true;
            }

            if (!image) {
                document.getElementById("imageError").textContent = "Please upload an image.";
                hasError = true;
            }

            if (!hasError) {
                // Hide form and show confirmation
                document.getElementById("registrationForm").style.display = 'none';
                document.getElementById("confirmationMessage").style.display = 'block';
            }
        }
    </script>

</body>
</html>
