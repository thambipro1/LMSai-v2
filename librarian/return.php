<?php 
include('header.php'); 
include('session.php'); 
include('navbar_borrow.php'); 
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">        
                <div class="alert alert-danger"><strong>Returned Books</strong></div>
                <div class="pull-right">
                    <a href="" onclick="window.print()" class="btn-default">Print</a>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                        <tr>
                            <th>Book Title</th>                                 
                            <th>Borrower</th>                                 
                            <th>Year Level</th>                                 
                            <th>Date Borrowed</th>                                 
                            <th>Due Date</th>                                 
                            <th>Date Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    // Establishing the database connection
                    $db = mysqli_connect("localhost", "root", "", "eb_lms");
                    if (!$db) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetching returned books with the corrected query
                    $query = "
                        SELECT 
                            book.book_title, 
                            member.firstname, 
                            member.lastname, 
                            member.year_level, 
                            borrow.date_borrow, 
                            borrow.due_date, 
                            borrowdetails.date_return  -- Corrected to borrowdetails.date_return
                        FROM 
                            borrow
                        LEFT JOIN 
                            member ON borrow.member_id = member.member_id
                        LEFT JOIN 
                            borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
                        LEFT JOIN 
                            book ON borrowdetails.book_id = book.book_id 
                        WHERE 
                            borrowdetails.borrow_status = 'returned'
                        ORDER BY 
                            borrow.borrow_id DESC";

                    if ($result = mysqli_query($db, $query)) {
                        // Loop through the returned books
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($row['year_level']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_borrow']); ?></td> 
                                <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_return']); ?></td>
                            </tr>
                            <?php 
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "<tr><td colspan='6'>Error fetching data: " . mysqli_error($db) . "</td></tr>";
                    }

                    // Closing the database connection
                    mysqli_close($db);
                    ?>
                    </tbody>
                </table>
            </div>        
        </div>
    </div>
</div>

<script>        
$(".uniform_on").change(function(){
    var max = 3;
    if ($(".uniform_on:checked").length == max) {
        $(".uniform_on").attr('disabled', 'disabled');
        alert('3 Books are allowed per borrow');
        $(".uniform_on:checked").removeAttr('disabled');
    } else {
        $(".uniform_on").removeAttr('disabled');
    }
});
</script> 

<?php include('footer.php'); ?>
