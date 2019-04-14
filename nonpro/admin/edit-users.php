<?php
    require 'header-admin.php';
    require 'admin.session.php';
    require '../includes/dbh.inc.php';
    $newId = NULL;
    if(isset($_GET['id'])){
        $newId = $_GET['id'];
    }
?>
<!--BOOTSTRAP CDN-->
<link rel="stylesheet" href="../resources/bootstrap.min.css">
    <title>Edit Users</title>
    <script
  src="../resources/jquery.min.js"
  ></script>
    <main>
    <div class="container">
        <?php
            require 'admin.php';
        ?>
            <!--Logout Form-->
    <form class="form-horizontal" action="../includes/logout.inc.php" method="post">
        <div class="form-group">
        <div class="col-sm-offset-0 col-sm-10">
            <button type="submit" name="logout-submit" class="btn btn-default">Logout</button>
        </div>
        </div>
    </form>
              <!--Signup Form Link-->
              <div class="container">
    <a href="signup.php">Signup</a>
    </div>
    <!--Link to Add Questions-->
      <div class="container">
        <a href="../non-pro-home.php">Add Questions</a>
      </div>
    <!--Link to View Questions-->
      <div class="container">
        <a href="view-questions.php">View Questions</a>
      </div>
    <!--Link to View Users-->
      <div class="container">
        <a href="view-users.php">View Users</a>
      </div>
        </div>

         <!--FORM-->
    <div class="container">
    <h1>Edit Users</h1>
    <?php require '../includes/edit-users-load.inc.php';?>
      <form action="../includes/edit-users.inc.php?id=<?php echo $newId;?>" method="post">
            <!--First Name-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="firstname">FirstName:</label>
                <div class="col-sm-4">
                    <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $_SESSION['first_name'];?>">
                </div>
        </div><br/><br/><br/>
        <!--Last Name-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="lastname">LastName:</label>
                <div class="col-sm-4">
                    <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $_SESSION['last_name'];?>">
                </div>
        </div><br/><br/>
        <!--Email-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo $_SESSION['email'];?>">
                </div>
        </div><br/><br/>
        <!--Username-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="username">Username:</label>
                <div class="col-sm-4">
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $_SESSION['username'];?>">
                </div>
        </div><br/><br/>
        <!--Password-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="password">Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="password" class="form-control" id="pwd" value="<?php echo $_SESSION['password'];?>">
                    <input type="checkbox" onclick="myFunction()">Show Password
                </div>
        </div><br/><br/>
        <div class="form-group">
        <div class="col-sm-offset-0 col-sm-10">
            <input type="submit" name="edit-submit" value="Update" />
            <br>
            <br>
            </div>
            <script>
            function myFunction() {
                var x = document.getElementById("pwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
                }
            </script>
            </div>
      </form>
    </div>
    </main>

<?php
    require '../footer.php';
?>
