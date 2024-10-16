<?php 
include('header.php'); 
include('session.php'); 
include('navbar_books.php'); 

// Get the book ID from the URL and validate it
$get_id = $_GET['id'] ?? null; 
if (!filter_var($get_id, FILTER_VALIDATE_INT)) {
    die("Error: Invalid Book ID.");
}

// Connect to the database
include('dbcon.php');

// Fetch book details using prepared statement
$stmt = $db->prepare("SELECT * FROM book LEFT JOIN category ON category.category_id = book.category_id WHERE book_id = ?");
$stmt->bind_param("i", $get_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: Book not found.");
}

$row = $result->fetch_assoc();
$category_id = $row['category_id'];
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger">
                    <i class="icon-pencil"></i>&nbsp;Edit Books
                </div>
                <p><a class="btn-default" href="books.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>

                <div class="addstudent">
                    <div class="details">Please Enter Details Below</div>    
                    <form class="form-horizontal" method="POST" action="update_books.php" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label" for="book_title">Book Title:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="book_title" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>" placeholder="Book Title" required>
                                <input type="hidden" name="id" value="<?php echo $get_id; ?>" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="category_id">Category:</label>
                            <div class="controls">
                                <select name="category_id" id="category_id" required>
                                    <option value="<?php echo $category_id; ?>"><?php echo htmlspecialchars($row['classname']); ?></option>
                                    <?php 
                                    // Fetch other categories
                                    $stmt_cat = $db->prepare("SELECT * FROM category WHERE category_id != ?");
                                    $stmt_cat->bind_param("i", $category_id);
                                    $stmt_cat->execute();
                                    $result_cat = $stmt_cat->get_result();
                                    while($row_cat = $result_cat->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row_cat['category_id']; ?>"><?php echo htmlspecialchars($row_cat['classname']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="author">Author:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" placeholder="Author" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="book_copies">Book Copies:</label>
                            <div class="controls">
                                <input class="span1" type="number" id="book_copies" name="book_copies" value="<?php echo htmlspecialchars($row['book_copies']); ?>" placeholder="Book Copies" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="book_pub">Publisher:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="book_pub" name="book_pub" value="<?php echo htmlspecialchars($row['book_pub']); ?>" placeholder="Publisher" required>
           
