<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_books.php'); ?>

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
                    <li class="active"><a href="old_books.php">Old Books</a></li>
                    <li><a href="lost.php">Lost Books</a></li>
                    <li><a href="damage.php">Damage Books</a></li>
                    <li><a href="sub_rep.php">Subject for Replacement</a></li>
                </ul>

                <center class="title">
                    <h1>Old Books</h1>
                </center>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                    <div class="pull-right">
                        <a href="" onclick="window.print()" class="btn-default">Print</a>
                    </div>
                    <p><a href="add_books.php" class="btn-default">&nbsp;Add Books</a></p>

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
                        // Include database connection
                        include('dbcon.php'); // Ensure this file connects to your database

                        // Query to get old books
                        $stmt = $db->prepare("SELECT b.*, c.classname FROM book b LEFT JOIN category c ON b.category_id = c.category_id WHERE b.status = 'old'");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['book_id'];
                        ?>
                            <tr class="del<?php echo $id; ?>">
                                <td><?php echo $row['book_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['classname']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td> 
                                <td class="action"><?php echo $row['book_copies']; ?></td>
                                <td><?php echo htmlspecialchars($row['book_pub']); ?></td>
                                <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                                <td><?php echo $row['copyright_year']; ?></td>        
                                <td><?php echo $row['date_added']; ?></td>
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
