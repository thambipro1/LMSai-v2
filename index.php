<link rel="stylesheet" href="css\styles.css">
<?php include('introanimation.php'); ?>
<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

//Header
<div class="container">
    <div class="margin-top">
        <div class="row">
            <?php include('head.php'); ?>
        </div>
        <div id="library-description" style="display: none;">
            <p>
                A Library Management System with AI integration is a digital platform designed to streamline library operations and enhance user experience. This system automates tasks such as cataloging, inventory management, and circulation processes, allowing librarians to manage resources efficiently. The AI component enhances functionalities by providing intelligent features like automated book recommendations based on user preferences, predictive analytics for inventory needs, and advanced search capabilities that understand natural language queries. Additionally, the system can offer personalized assistance through chatbots, improving user engagement and satisfaction. Overall, this integration aims to make library services more accessible and efficient for both librarians and patrons.
            </p>
        </div>
        <div class="span2">
            <h4></h4>
        </div>
        <div class="span10"></div>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Set a timer for 2 seconds before fading in the text
    setTimeout(function() {
        $('#library-description').fadeIn(1000); // Fade in over 1 second
    }, 2100); // 2 seconds delay before starting the animation
});

</script>
