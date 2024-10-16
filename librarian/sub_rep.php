<?php 
include('header.php'); 
include('session.php'); 
include('navbar_books.php'); 
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-user icon-large"></i>&nbsp;Books Table</strong>
                </div>
                
                <ul class="nav nav-pills">
                    <li><a href="books.php">All</a></li>
                    <li><a href="new_books.php">New Books</a></li>
                    <li><a href="old_books.php">Old Books</a></li>
                    <li><a href="lost.php">Lost Books</a></li>
                    <li><a href="damage.php">Damage Books</a></li>
                    <li class="active"><a href="sub_rep.php">Subject for Replacement</a></li>
                </ul>

                <center class="title">
                    <h1>Subject for Replacement</h1>
                </center>
                
                <div class="pull-right">
                    <a href="" onclick="window.print()" class="btn-default">Print</a>
                </div>
                <p><a href="add_books.php" class="btn-default">&nbsp;Add Books</a></p>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>Acc No.</th>                                 
                            <th>Book Title</th>                                 
                            <th>Category</th>
                            <th>Author</th>
                            <th class="action">Copies</th>
                            <th>Book Pub</th>
                            <th>Publisher Name</th>
                            <th>ISBN</th>
                            <th>Copyright Year</th>
                            <th>Date Added</th>
                            <th class="action">Action</th>        
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    // Fetch books marked as "Subject for Replacement"
                    $query = "SELECT * FROM book WHERE status = 'Subject for Replacement'";
                    $user_query = mysqli_query($db, $query);

                    while ($row = mysqli_fetch_array($user_query)) {
                        $id = $row['book_id'];  
                        $cat_id = $row['category_id'];

                        // Fetch category name
                        $cat_query = mysqli_query($db, "SELECT * FROM category WHERE category_id = '$cat_id'");
                        $cat_row = mysqli_fetch_array($cat_query);
                    ?>
                    <tr class="del<?php echo $id; ?>">
                        <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($cat_row['classname']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td class="action"><?php echo htmlspecialchars($row['book_copies']); ?></td>
                        <td><?php echo htmlspecialchars($row['book_pub']); ?></td>
                        <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($row['copyright_year']); ?></td>        
                        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                        <?php include('toolttip_edit_delete.php'); ?>
                        <td class="action">
                            <div class="span2">
                                <a rel="tooltip" title="Delete" id="<?php echo $id; ?>" href="#delete_book<?php echo $id; ?>" data-toggle="modal" class="btn-default"><i class="icon-trash icon-large"></i></a>
                                <?php include('delete_book_modal.php'); ?>
                                <div class="span1">
                                    <a rel="tooltip" title="Edit" id="e<?php echo $id; ?>" href="edit_book.php?id=<?php echo $id; ?>" class="btn-default"><i class="icon-pencil icon-large"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>        
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
