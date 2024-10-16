<?php 
include('header.php'); 
include('session.php'); 
include('navbar_archive.php'); 
include('db_connection.php'); // Ensures the `$db` connection is included
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <ul class="nav nav-pills">
                    <li class="active"><a href="archive.php">Archive</a></li>
                </ul>
                <center class="title">
                    <h1>Books List</h1>
                </center>
                <div class="pull-right">
                    <a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>Acc No.</th>                                 
                            <th>Book Title</th>                                 
                            <th>Category</th>
                            <th>Author</th>
                            <th>Copies</th>
                            <th>Book Pub</th>
                            <th>Publisher Name</th>
                            <th>ISBN</th>
                            <th>Copyright Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        $stmt = $db->prepare("SELECT * FROM book WHERE status = ?");
                        $archiveStatus = 'Archive';
                        $stmt->bind_param('s', $archiveStatus);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()){
                            $id = $row['book_id'];  
                            $cat_id = $row['category_id'];

                            $cat_stmt = $db->prepare("SELECT * FROM category WHERE category_id = ?");
                            $cat_stmt->bind_param('i', $cat_id);
                            $cat_stmt->execute();
                            $cat_result = $cat_stmt->get_result();
                            $cat_row = $cat_result->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $row['book_id']; ?></td>
                            <td><?php echo $row['book_title']; ?></td>
                            <td><?php echo $cat_row['classname']; ?> </td>
                            <td><?php echo $row['author']; ?> </td> 
                            <td><?php echo $row['book_copies']; ?> </td>
                            <td><?php echo $row['book_pub']; ?></td>
                            <td><?php echo $row['publisher_name']; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td><?php echo $row['copyright_year']; ?></td>        
                        </tr>
                        <?php 
                        }  
                        $stmt->close();
                        $cat_stmt->close();
                        $db->close();
                        ?>
                    </tbody>
                </table>
            </div>        
        </div>
    </div>
</div>

<?php include('footer.php') ?>
