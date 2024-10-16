<?php 
include('header.php'); 
include('session.php'); 
include('navbar_member.php'); 

// Get the member ID from the URL and validate it
$get_id = $_GET['id'] ?? null; 
if (!filter_var($get_id, FILTER_VALIDATE_INT)) {
    die("Error: Invalid Member ID.");
}

// Connect to the database
include('dbcon.php');

// Fetch member details using prepared statement
$stmt = $db->prepare("SELECT * FROM member WHERE member_id = ?");
$stmt->bind_param("i", $get_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: Member not found.");
}

$row = $result->fetch_assoc();
?>

<div class="container">
    <div class="margin-top">
        <div class="row">	
            <div class="span12">	
                <div class="alert alert-danger"><i class="icon-pencil"></i>&nbsp;Edit Member</div>
                <p><a class="btn-default" href="member.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>

                <div class="addstudent">
                    <div class="details">Please Enter Details Below</div>	
                    <form class="form-horizontal" method="POST" action="update_member.php" enctype="multipart/form-data">
                        
                        <div class="control-group">
                            <label class="control-label" for="firstname">Firstname:</label>
                            <div class="controls">
                                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" placeholder="Firstname" required>
                                <input type="hidden" name="id" value="<?php echo $get_id; ?>" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="lastname">Lastname:</label>
                            <div class="controls">
                                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" placeholder="Lastname" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="gender">Gender:</label>
                            <div class="controls">
                                <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" placeholder="Gender" required>
                            </div>
                        </div>	

                        <div class="control-group">
                            <label class="control-label" for="address">Address:</label>
                            <div class="controls">
                                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" placeholder="Address" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="contact">Contact:</label>
                            <div class="controls">
                                <input type="tel" pattern="[0-9]{11,11}" class="search" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" placeholder="Phone Number" autocomplete="off" maxlength="11" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="type">Type:</label>
                            <div class="controls">
                                <select name="type" id="type" required>
                                    <option><?php echo htmlspecialchars($row['type']); ?></option>
                                    <option>Student</option>
                                    <option>Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="year_level">Year Level:</label>
                            <div class="controls">
                                <select name="year_level" id="year_level" required>
                                    <option><?php echo htmlspecialchars($row['year_level']); ?></option>
                                    <option>First Year</option>
                                    <option>Second Year</option>
                                    <option>Third Year</option>
                                    <option>Fourth Year</option>
                                    <option>Faculty</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="status">Status:</label>
                            <div class="controls">
                                <select name="status" id="status" required>
                                    <option><?php echo htmlspecialchars($row['status']); ?></option>
                                    <option>Active</option>
                                    <option>Banned</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button name="submit" type="submit" class="btn btn-default"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                            </div>
                        </div>
                    </form>				
                </div>		
            </div>		
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
