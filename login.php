<?php include 'includes/connection.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- <link rel="stylesheet" type="text/css" href="login_styles.css" media="all" /> -->
<?php
session_start();
if (isset($_POST['login'])) {
  $username  = $_POST['user'];
  $password = $_POST['pass'];
  mysqli_real_escape_string($conn, $username);
  mysqli_real_escape_string($conn, $password);
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $user = $row['username'];
      $pass = $row['password'];
      $name = $row['name'];
      $email = $row['email'];
      $role = $row['role'];
      $course = $row['course'];
      if (password_verify($password, $pass)) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['email']  = $email;
        $_SESSION['role'] = $role;
        $_SESSION['course'] = $course;
        header('location: dashboard/');
      } else {
        echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";
      }
    }
  } else {
    echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";
  }
}
?>
<div class="container">

  <div class="well form-horizontal">
    <fieldset>
      <legend>
        <center>
          <h2><b>Faculty Login Form</b></h2>
        </center>
      </legend><br>

    <form method="POST">
      <div class="form-group">
        <label class="col-md-4 control-label">Username</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="user" placeholder="Username" class="form-control" type="text" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input name="pass" placeholder="Password" class="form-control" type="password" required="">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4"><br>
        <input type="submit" name="login" class="btn btn-primary" value="login">
        </div>
      </div>
    </form>

    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <a href="signup.php">Create Account</a>
        </div>
      </div>
</div>

    </fieldset>
</div>
</div><!-- /.container -->

<script src='css/jquery.min.js'></script>
<script src='css/jquery-ui.min.js'></script>


</body>

</html>