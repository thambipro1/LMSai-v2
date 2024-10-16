<?php 
include('navbar_contactus.php'); 
include('header.php'); 

// PHP: Initialize variables for error messages and success message
$firstNameErr = $lastNameErr = $emailErr = $messageErr = $successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['fname']);
    $lastName = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $isValid = true;

    // Validate First Name
    if (empty($firstName)) {
        $firstNameErr = "First name is required.";
        $isValid = false;
    }

    // Validate Last Name
    if (empty($lastName)) {
        $lastNameErr = "Last name is required.";
        $isValid = false;
    }

    // Validate Email
    if (empty($email)) {
        $emailErr = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $isValid = false;
    }

    // Validate Message
    if (empty($message)) {
        $messageErr = "Message is required.";
        $isValid = false;
    }

    // If valid, send the email
    if ($isValid) {
        $to = "vishvaparamasivam1@gmail.com";
        $subject = "New Contact Form Submission";
        $body = "First Name: $firstName\nLast Name: $lastName\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: " . $email;

        if (mail($to, $subject, $body, $headers)) {
            $successMsg = "Your message has been sent successfully!";
        } else {
            $successMsg = "Sorry, there was an error sending your message. Please try again later.";
        }
    }
}
?>

<div class="container" style="padding: 30px;">
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        <?php include('head.php'); ?>
    </div>
    <div class="contact-form" style="animation: fadeIn 1s;">
        <h2 style="text-align: center; color: #333; font-size: 1.5em;">Get in Touch</h2>
        <p style="text-align: center; color: #666;">Feel free to drop us a message using the form below!</p>

        <!-- Display Success Message -->
        <?php if (!empty($successMsg)) echo "<div class='alert' style='color: green; text-align: center;'>$successMsg</div>"; ?>

        <form method="post" action="" style="margin-top: 20px;">
            <div style="margin-bottom: 15px;">
                <label for="fname" style="color: #555; font-weight: bold;">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="Your First Name" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                <span style="color: red;"><?php echo $firstNameErr; ?></span>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="lname" style="color: #555; font-weight: bold;">Last Name</label>
                <input type="text" id="lname" name="lname" placeholder="Your Last Name" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                <span style="color: red;"><?php echo $lastNameErr; ?></span>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="color: #555; font-weight: bold;">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" value="<?php echo isset($email) ? $email : ''; ?>" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                <span style="color: red;"><?php echo $emailErr; ?></span>
            </div>
            <div style="margin-bottom: 20px;">
                <label for="message" style="color: #555; font-weight: bold;">Message</label>
                <textarea id="message" name="message" placeholder="Type your message here..." required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; height: 150px;"><?php echo isset($message) ? $message : ''; ?></textarea>
                <span style="color: red;"><?php echo $messageErr; ?></span>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="send-btn" style="padding: 12px 25px; background-color: #007bff; color: #fff; border: none; border-radius: 6px; cursor: pointer;">Send Message</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- Inline Styles for the Redesigned Form -->
<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.contact-form {
    max-width: 600px;
    margin: auto;
    padding: 25px;
    background: #f7f7f7;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.alert {
    font-size: 14px;
    margin-top: 15px;
}

.send-btn:hover {
    background-color: #0056b3;
}

.send-btn:focus {
    outline: none;
}
</style>
