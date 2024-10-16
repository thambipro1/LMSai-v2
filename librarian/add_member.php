<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_member.php'); ?>
    <div class="container">
        <div class="margin-top">
            <div class="row">    
                <div class="span12">    
        
                    <div class="alert alert-danger">Add Member</div>
                    <p><a href="member.php" class="btn-default"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
                    <div class="addstudent">
                        <div class="details">Please Enter Details Below</div>        
                        <form class="form-horizontal" method="POST" action="member_save.php" enctype="multipart/form-data">
                        
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Firstname:</label>
                                <div class="controls">
                                    <input type="text" id="inputEmail" name="firstname" placeholder="Firstname" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Lastname:</label>
                                <div class="controls">
                                    <input type="text" id="inputPassword" name="lastname" placeholder="Lastname" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Gender:</label>
                                <div class="controls">
                                    <select name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Address:</label>
                                <div class="controls">
                                    <input type="text" id="inputPassword" name="address" placeholder="Address" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Cellphone Number:</label>
                                <div class="controls">
                                    <input type="tel" pattern="[0-9]{10,11}" name="contact" placeholder="Phone Number" maxlength="11" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Type:</label>
                                <div class="controls">
                                    <select name="type" required>
                                        <option value="">Select Type</option>
                                        <option>Student</option>
                                        <option>Teacher</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Year Level:</label>
                                <div class="controls">
                                    <select name="year_level">
                                        <option value="">Select Year Level</option>
                                        <option>First Year</option>
                                        <option>Second Year</option>
                                        <option>Third Year</option>
                                        <option>Fourth Year</option>
                                        <option>Faculty</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button name="submit" type="submit" class="btn btn-default"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </form>                    
                    </div>        
                </div>        
            </div>
        </div>
    </div>
<?php include('footer.php') ?>
