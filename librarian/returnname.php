<form class="form-horizontal" method="post" action="your_action_page.php">
    <div class="control-group">
        <label class="control-label" for="returnee_name">Member Name</label>
        <div class="controls">
            <select name="returnee_name" id="returnee_name" required>
                <option value="" disabled selected>Select Member</option>
                <?php 
                // Establish database connection
                $db = mysqli_connect("localhost", "root", "", "eb_lms");
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch members from the database
                $result = mysqli_query($db, "SELECT * FROM member") or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo htmlspecialchars($row['member_id']); ?>">
                        <?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?>
                    </option>
                <?php } 
                mysqli_free_result($result);
                mysqli_close($db);
                ?>
            </select>
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label" for="due_date">Due Date</label>
        <div class="controls">
            <input type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="due_date" maxlength="10" style="border: 3px double #CCCCCC;" required placeholder="DD-MM-YYYY"/>
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label" for="return_date">Return Date</label>
        <div class="controls">
            <input type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="return_date" id="return_date" maxlength="10" style="border: 3px double #CCCCCC;" required placeholder="DD-MM-YYYY"/>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
