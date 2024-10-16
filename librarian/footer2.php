<!-- Include CSS for Chosen and Uniform -->
<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">

<!-- Include JavaScript Libraries -->
<script src="vendors/jquery.min.js"></script> <!-- Ensure jQuery is loaded first -->
<script src="vendors/chosen.jquery.min.js"></script>
<script src="vendors/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Chosen for dropdowns
        $(".chzn-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%" // Ensures dropdowns are responsive
        });

        // Uncomment and initialize if needed
        // $(".datepicker").datepicker({
        //     format: "mm/dd/yyyy", // Specify the date format
        //     autoclose: true // Automatically close the datepicker when a date is selected
        // });

        // $(".uniform_on").uniform(); // Initialize Uniform for styled inputs
        // $('.textarea').wysihtml5(); // Initialize WYSIWYG editor
    });
</script>

</body>
</html>
