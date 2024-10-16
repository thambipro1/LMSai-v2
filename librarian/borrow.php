<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-user icon-large"></i>&nbsp;Borrow Table</strong>
            </div>

            <div class="span12">        
                <form method="post" action="borrow_save.php">
                    <div class="span3">

                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Borrower Name</label>
                            <div class="controls">
                                <select name="member_id" class="chzn-select" required>
                                    <option value="" disabled selected>Select Borrower</option>
                                    <?php 
                                    $result = $db->query("SELECT * FROM member");
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['member_id']; ?>"><?php echo $row['firstname'] . " " . $row['lastname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group"> 
                            <label class="control-label" for="due_date">Due Date</label>
                            <div class="controls">
                                <input type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="due_date" maxlength="10" placeholder="DD-MM-YYYY" style="border: 3px double #CCCCCC;" required/>
                            </div>
                        </div>

                        <div class="control-group"> 
                            <div class="controls">
                                <button name="borrow" class="btn btn-default">Borrow</button>
                            </div>
                        </div>

                    </div>

                    <div class="span8">
                        <div class="alert alert-success"><strong>Select Book</strong></div>
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                            <thead>
                                <tr>
                                    <th>Acc No.</th>                                 
                                    <th>Book Title</th>                                 
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Publisher Name</th>
                                    <th>Status</th>
                                    <th>Add</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php  
                                $user_query = $db->query("SELECT * FROM book WHERE status != 'Archive'");
                                while ($row = $user_query->fetch_assoc()) {
                                    $id = $row['book_id'];  
                                    $cat_id = $row['category_id'];

                                    $cat_query = $db->query("SELECT * FROM category WHERE category_id = '$cat_id'");
                                    $cat_row = $cat_query->fetch_assoc();
                                ?>
                                    <tr class="del<?php echo $id; ?>">
                                        <td><?php echo $row['book_id']; ?></td>
                                        <td><?php echo $row['book_title']; ?></td>
                                        <td><?php echo $cat_row['classname']; ?></td> 
                                        <td><?php echo $row['author']; ?></td> 
                                        <td><?php echo $row['publisher_name']; ?></td>
                                        <td><?php echo $row['status']; ?></td> 
                                        <td width="20">
                                            <input class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>        
        </div>        

        <script>        
            $(".uniform_on").change(function() {
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
    </div>
</div>

<?php include('footer.php'); ?>
