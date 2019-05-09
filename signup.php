<?php
require "header.php"; ?>

<div class="bs-docs-section">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            <div class="page-header">
                <h1 id="forms">Sign Up</h1>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            <div class="well bs-component">
                <?php if (!empty($_POST)):
                    $error = "";
                    /*$db->select(
                        'ID',
                        'user',
                        'ID = ?',
                        array($_POST['ID']));
                    if($db->returned_rows==0) {
                    }else{ $error .= "ID already registered! </br> ";}*/

                    $db->select(
                        'email',
                        'user',
                        'email = ?',
                        array($_POST['inputEmail']));
                    if($db->returned_rows==0) {
                    }else{ $error .= "Email already registered! </br> ";}

                    if($_POST['inputPassword']==$_POST['confirmPassword']){
                    }else{$error .= "Password does not Match! </br> ";}

                    if($error=="")
                    {
                        date_default_timezone_set("Asia/Dhaka");
                        $db->insert(
                            'user',
                            array(
                                'first_name'   =>  $_POST["first_name"],
                                'last_name'   =>  $_POST["last_name"],
                                'email'   =>  $_POST["inputEmail"],
                                'password'   =>  $_POST["inputPassword"],
                                'created_On' => date("Y-m-d H:i:s"),
                            ));
                ?><blockquote>
                        <p><?php echo "Successfully Signed Up, Please sign in to get started." ?></p>
                </blockquote><?php
                    }
                        else
                        {
                            ?>
                            <form class="form-horizontal" data-toggle="validator" role="form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                                <fieldset>
                                    <legend>Information</legend>
                                    <blockquote>
                                        <p><?php echo $error; ?></p>
                                    </blockquote>
                                    <div class="form-group">
                                        <label for="first_name" class="col-lg-2 control-label">First Name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="first_name" placeholder="First Name" value="<?php echo $_POST['first_name'];?>" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-lg-2 control-label">Last Name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo $_POST['last_name'];?>" name="last_name" required>
                                        </div>
                                    </div>
                                  <!--  <div class="form-group">
                                        <label for="ID" class="col-lg-2 control-label">ID</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="ID" name="ID" value="<?php /*echo $_POST['ID'];*/?>" placeholder="" required>
                                        </div>

                                    </div>-->
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="inputEmail" value="<?php echo $_POST['inputEmail'];?>" placeholder="Email" name="inputEmail"required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" id="inputPassword" value="<?php echo $_POST['inputPassword'];?>" placeholder="Password" name="inputPassword" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword" class="col-lg-2 control-label">Confirm Password</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" id="confirmPassword" value="<?php echo $_POST['confirmPassword'];?>" placeholder="" name="confirmPassword" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Gender</label>
                                        <div class="col-lg-10">
                                            <div class="radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" id="optionsRadios1"  value="Male" <?php if( $_POST['gender']=="Male") echo "Checked";?> required>
                                                    Male
                                                </label>
                                            </div>
                                            <div class="radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" id="optionsRadios2"  value="Female" <?php if( $_POST['gender']=="Female") echo "Checked";?> required>
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="select" class="col-lg-2 control-label">Type of User</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" id="select"  name="typeSelect" required>
                                                <option <?php if( $_POST['typeSelect']=="Student") echo "Selected"?> >Student</option>
                                                <option <?php if( $_POST['typeSelect']=="Teacher") echo "Selected"?> >Teacher</option>
                                            </select>
                                            <br>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <?php
                        }

                    ?>
                <?php else: ?>
                <form class="form-horizontal" data-toggle="validator" role="form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <fieldset>
                        <legend>Information</legend>
                        <div class="form-group">
                            <label for="first_name" class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="ID" class="col-lg-2 control-label">ID</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
                            </div>
                        </div>-->
                        <!--<div class="form-group">
                            <label for="select" class="col-lg-2 control-label">Department</label>
                            <div class="col-lg-10">
                                <select class="form-control" id="select"  name="dept" required>
                                    <option>CSE</option>
                                    <option>EEE</option>
                                    <option>BBA</option>
                                    <option>PHARM</option>
                                    <option>ARCH</option>
                                    <option>ECO</option>
                                    <option>ENV</option>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="inputEmail"required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="inputPassword" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword" class="col-lg-2 control-label">Confirm Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="" name="confirmPassword" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Gender</label>
                            <div class="col-lg-10">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios1" value="Male" checked="" required>
                                        Male
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios2" value="Female" required>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="select" class="col-lg-2 control-label">Type of User</label>
                            <div class="col-lg-10">
                                <select class="form-control" id="select" name="typeSelect" required>
                                    <option>Student</option>
                                    <option>Teacher</option>
                                </select>
                                <br>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php require "footer.php"; ?>