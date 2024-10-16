<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #161616;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: transform 1s ease, opacity 1s ease; /* Transition for both transform and opacity */
            transform: translateY(0);
            opacity: 1; /* Initial opacity */
        }

        .splash-screen img {
            max-width: 80%; /* Adjust size as needed */
            max-height: 80%; /* Adjust size as needed */
        }

        .content {
            display: none;
            padding: 20px;
            text-align: center;
        }

        .fade-in {
            display: block;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="splash-screen" id="splashScreen">
        <img src="LMS\logo.png" alt="Logo"> <!-- Replace 'logo.png' with your logo file -->
    </div>

    <script>
        window.onload = function() {
            const splashScreen = document.getElementById('splashScreen');
            const mainContent = document.getElementById('mainContent');

            // After a short delay, hide the splash screen and show the main content
            setTimeout(() => {
                splashScreen.style.opacity = '0'; // Fade out the splash screen
                splashScreen.style.transform = 'translateY(-100%)'; // Slide up
                mainContent.classList.add('fade-in'); // Fade in the main content
            }, 2000); // 2 seconds splash screen duration
        }
    </script>
</body>
</html>
