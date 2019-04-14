<?php
    require 'header.php';
    session_start();
    if (isset($_SESSION['id'])) {
        header("Location: admin/home.php");
        exit();
    }
?>
    <main>
    <div class="container text-center">
      <img class="LTOLogo" src="../images/LTOLOGO.png">
      <br/>
      <br/>
      <br/>
        <h1 style="color: #0236B1;">LOGIN</h1><br/><br/>
            <!--Login Form-->
            <form class="form-horizontal" action="includes/login.inc.php" method="post">
            <div class="text-center">  
            <div class="form-group">
                <label class="control-label col-sm-4" for="usernameemail" style="color: #0236B1;">Username:</label>
                  <div class="col-sm-4">
                    <input type="text" name="usernameemail" class="form-control" id="username" placeholder="Enter username">
                  </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="password" style="color: #0236B1;">Password:</label>
                <div class="col-sm-4">
                  <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
              </div>
              <a href="../index.php">Change Login</a>
            </div><br/><br/>
              <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                  <button type="submit" name="login-submit" class="btn btn-primary">Login</button>
                </div>
              </div>
            </form>
            <br>
        </div>
    </main>
<?php
    require 'footer.php';
?>

