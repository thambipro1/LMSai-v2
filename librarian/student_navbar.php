<?php
session_start();
?>

<nav class="student-navbar fade-in">
    <div class="navbar-content">
        <?php if (isset($_SESSION['student_no'])): ?>
            <div class="user-info">
                <img src="<?php echo $_SESSION['photo'] ?? 'default-avatar.png'; ?>" alt="Profile Picture" class="profile-pic">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['student_no']); ?></span>
            </div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<!-- CSS for the student navbar -->
<style>
    .student-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #28a745; /* Match the color scheme */
        color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
        position: sticky; /* Keeps navbar at top on scroll */
        top: 0; /* Position it at the top */
        z-index: 1000; /* Ensures it stays above other content */
        opacity: 0; /* Start invisible */
        animation: fadeIn 0.8s forwards; /* Fade-in effect */
    }

    .navbar-content {
        display: flex;
        align-items: center;
        width: 100%; /* Use full width */
        justify-content: space-between; /* Space between items */
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .profile-pic {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-name {
        font-size: 16px;
        font-weight: bold;
    }

    .logout a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        padding: 5px 10px;
        background-color: #dc3545; /* Match logout button color */
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .logout a:hover {
        background-color: #c82333;
    }

    @keyframes fadeIn {
        from {
            opacity: 0; /* Start invisible */
            transform: translateY(-20px); /* Slide in from above */
        }
        to {
            opacity: 1; /* Fully visible */
            transform: translateY(0); /* Normal position */
        }
    }
</style>
