<?php
    require 'header-admin.php';
?>
<!--BOOTSTRAP CDN-->
<link rel="stylesheet" href="../resources/bootstrap.min.css">
    <title>Add Users</title>
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
    <a href="home.php">Add Question</a>
    </div>
        <!--Link to View Questions-->
        <div class="container">
            <a href="view-questions.php">View Questions</a>
        </div>
        <!--Link to View Users-->
        <div class="container">
            <a href="view-users.php">View Users</a>
        </div>
    <h1>Add Users</h1>
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == "emptyfields") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Empty Fields</b></p>";
        } elseif($_GET['error'] == "invalidName") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Invalid Name</b></p>";
        } elseif($_GET['error'] == "invalidEmailandUsername") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Invalid Username and Email</b></p>";
        } elseif($_GET['error'] == "invalidEmail") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Invalid Email</b></p>";
        } elseif($_GET['error'] == "invalidUsername") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Invalid Username</b></p>";
        } elseif($_GET['error'] == "passwordcheck") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Password Doesn't Match!</b></p>";
        } elseif($_GET['error'] == "usertaken") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Username Already Taken!</b></p>";
        }
    } elseif(isset($_GET['signup'])) {
        if($_GET['signup'] == "success") {
            echo "<p class='text-success'><b><span class='text-success'>&#10003;</span> User Added!</b></p>";
        }
    }
    ?>
    <!--Signup Form-->
        <form class="form-horizontal" action="../includes/signup.inc.php" method="post">
        <!--First Name-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="firstname">FirstName:</label>
                <div class="col-sm-4">
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter firstname">
                </div>
        </div>
        <!--Last Name-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="latname">LastName:</label>
                <div class="col-sm-4">
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter lastname">
                </div>
        </div>
        <!--Email-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
        </div>
        <!--Username-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="username">Username:</label>
                <div class="col-sm-4">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                </div>
        </div>
        <!--Password-->
        <div class="form-group">
            <label class="control-label col-sm-1" for="password">Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
        </div>
        <!--Confirm Password-->
            <div class="form-group">
                <label class="control-label col-sm-1" for="confirmpassword">Confirm:</label>
                <div class="col-sm-4">
                <input type="password" name="confirmpassword" class="form-control" id="pwd" placeholder="Confirm password">
                </div>
            </div>
        <!--Submit Button-->
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <button type="submit" name="signup-submit" class="btn btn-default">Signup</button>
                </div>
            </div>

        </form>
    </div>
</main>
<?php
    require '../footer.php';
?>
