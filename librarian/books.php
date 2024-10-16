<?php 
include('header.php'); 
include('session.php'); 
include('navbar_books.php'); 
include('dbcon.php'); // Assuming dbcon.php contains your MySQLi connection code

// Fetch books data
$query = "SELECT b.book_id, b.book_title, b.author, b.book_pub, b.publisher_name, b.isbn, b.copyright_year, b.date_added, b.status, b.book_copies, c.classname
          FROM book AS b
          JOIN category AS c ON b.category_id = c.category_id
          WHERE b.status != 'Archive'";

$result = mysqli_query($db, $query);
?>
<div class="container">
	<div class="margin-top">
		<div class="row">	
			<div class="span12">	
			   <div class="alert alert-danger">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                   <strong><i class="icon-user icon-large"></i>&nbsp;Books Table</strong>
               </div>

			   <!-- Navigation -->
			   <ul class="nav nav-pills nav-justified">
					<li class="active"><a href="books.php">All</a></li>
					<li><a href="new_books.php">New Books</a></li>
					<li><a href="old_books.php">Old Books</a></li>
					<li><a href="lost.php">Lost Books</a></li>
					<li><a href="damage.php">Damage Books</a></li>
					<li><a href="sub_rep.php">Subject for Replacement</a></li>
			   </ul>

			   <!-- Books List -->
			   <center class="title">
					<h1>Books List</h1>
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
							<th>Status</th>
							<th class="action">Action</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
						while ($row = mysqli_fetch_assoc($result)) {
							$id = $row['book_id'];
							$book_copies = $row['book_copies'];
                            
							// Fetch borrow details
							$borrow_query = "SELECT COUNT(*) as count FROM borrowdetails WHERE book_id = '$id' AND borrow_status = 'pending'";
							$borrow_result = mysqli_query($db, $borrow_query);
							$borrow_data = mysqli_fetch_assoc($borrow_result);
							$count = $borrow_data['count'];
							
							$total = $book_copies - $count; 
						?>
						<tr class="del<?php echo $id; ?>">
							<td><?php echo $row['book_id']; ?></td>
							<td><?php echo $row['book_title']; ?></td>
							<td><?php echo $row['classname']; ?></td>
							<td><?php echo $row['author']; ?></td> 
							<td class="action"><?php echo $total; ?></td>
							<td><?php echo $row['book_pub']; ?></td>
							<td><?php echo $row['publisher_name']; ?></td>
							<td><?php echo $row['isbn']; ?></td>
							<td><?php echo $row['copyright_year']; ?></td>		
							<td><?php echo $row['date_added']; ?></td>
							<td><?php echo $row['status']; ?></td>
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
						<?php 
                            mysqli_free_result($borrow_result); // Free result set for each borrow query
                        } 
                        mysqli_free_result($result); // Free result set for books query
                        ?>
					</tbody>
				</table>
			</div>		
		</div>
	</div>
</div>
<?php include('footer.php'); ?>
<?php mysqli_close($db); // Close the database connection ?>
