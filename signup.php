<?php include 'includes/connection.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php
if (isset($_POST['signup'])) {
  require "gump.class.php";
  $gump = new GUMP();
  $_POST = $gump->sanitize($_POST);

  $gump->validation_rules(array(
    'username'    => 'required|alpha_numeric|max_len,20|min_len,4',
    'name'        => 'required|alpha_space|max_len,30|min_len,5',
    'email'       => 'required|valid_email',
    'password'    => 'required|max_len,50|min_len,6',
  ));
  $gump->filter_rules(array(
    'username' => 'trim|sanitize_string',
    'name'     => 'trim|sanitize_string',
    'password' => 'trim',
    'email'    => 'trim|sanitize_email',
  ));
  $validated_data = $gump->run($_POST);

  if ($validated_data === false) {
?>
    <center>
      <font color="red"> <?php echo $gump->get_readable_errors(true); ?> </font>
    </center>
<?php
  } else if ($_POST['password'] !== $_POST['repassword']) {
    echo  "<center><font color='red'>Passwords do not match </font></center>";
  } else {
    $username = $validated_data['username'];
    $checkusername = "SELECT * FROM users WHERE username = '$username'";
    $run_check = mysqli_query($conn, $checkusername) or die(mysqli_error($conn));
    $countusername = mysqli_num_rows($run_check);
    if ($countusername > 0) {
      echo  "<center><font color='red'>Username is already taken! try a different one</font></center>";
    }
    $email = $validated_data['email'];
    $checkemail = "SELECT * FROM users WHERE email = '$email'";
    $run_check = mysqli_query($conn, $checkemail) or die(mysqli_error($conn));
    $countemail = mysqli_num_rows($run_check);
    if ($countemail > 0) {
      echo  "<center><font color='red'>Email is already taken! try a different one</font></center>";
    } else {
      $name = $validated_data['name'];
      $email = $validated_data['email'];
      $pass = $validated_data['password'];
      $password = password_hash("$pass", PASSWORD_DEFAULT);
      $role = $_POST['role'];
      $course = $_POST['course'];
      $gender = $_POST['gender'];
      $joindate = date("F j, Y");
      $query = "INSERT INTO users(username,name,email,password,role,course,gender,joindate,token) VALUES ('$username' , '$name' , '$email', '$password' , '$role', '$course', '$gender' , '$joindate' , '' )";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('SUCCESSFULLY REGISTERED');
        window.location.href='login.php';</script>";
      } else {
        echo "<script>alert('Error Occured');</script>";
      }
    }
  }
}
?>
<br>

<body>
<div class="container">

  <div class="well form-horizontal">
    <fieldset>
      <legend>
        <center>
          <h2><b>Faculty Signup</b></h2>
        </center>
      </legend><br>

      <form id="contactform" method="POST">
        <div class="form-group">
          <form id="contactform" method="POST">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="name" name="name" placeholder="First And Last Name" class="form-control" type="text" required="" value="<?php if (isset($_POST['signup'])) {
                                                                                                                                      echo $_POST['name'];
                                                                                                                                    } ?>">
              </div>
            </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="email">Email</label>
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input id="email" name="email" placeholder="example@domain.com" class="form-control" type="email" required="" value="<?php if (isset($_POST['signup'])) {
                                                                                                                                      echo $_POST['email'];
                                                                                                                                    } ?>">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="username">Create Username</label>
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="username" name="username" placeholder="username" class="form-control" type="text" required="" value="<?php if (isset($_POST['signup'])) {
                                                                                                                                echo $_POST['username'];
                                                                                                                              } ?>">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="password">Create A Password</label>
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input name="password" placeholder="Create A Password" class="form-control" type="password" id="password" required="">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="repassword">Confirm Password</label>
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input name="repassword" placeholder="Confirm Password" class="form-control" type="password" id="repassword" required="">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="gender">Gender</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="gender" class="form-control selectpicker">
                <option value="">Select Your Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="role">I'm a...</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="role" class="form-control selectpicker">
                <option value="">Select Your Role</option>
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="course">I Teach/Study......</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="course" class="form-control selectpicker">
                <option value="">Select Your Course</option>
                <option value="Computer Sc">Computer Science & Engineering</option>
                <option value="Mechanical">Mechanical Engineering</option>
                <option value="Electrical">Electrical Engineering</option>
                <option value="Civil">Civil Engineering</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4"><br>
        <input class="btn btn-primary" name="signup" id="submit" tabindex="5" value="Sign me up!" type="submit">
        </div>
      </div>
      </form>
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <a href="login.php">Already Have An Account Click Here</a>
        </div>
    </fieldset>
  </div>
</div>

</body>

</html>