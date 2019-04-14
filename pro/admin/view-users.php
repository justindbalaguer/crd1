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
    <title>View Users</title>
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
    <a href="signup.php">Add Users</a>
    </div>
    <!--Link to View Questions-->
    <div class="container">
        <a href="home.php">Add Questions</a>
    </div>
    <!--Link to View Users-->
    <div class="container">
        <a href="view-questions.php">View Questions</a>
    </div>
        <h1>View Users</h1>
        <?php
    if(isset($_GET['update'])) {
        if($_GET['update'] == "success") {
            echo "<p class='text-success'><b><span class='text-success'>&#10003;</span> User Updated!</b></p>";
        }
    } elseif(isset($_GET['delete'])) {
        if($_GET['delete'] == "success") {
            echo "<p class='text-danger'><b><span class='text-success'>&#10003;</span> User Deleted!</b></p>";
        }
    }
    ?>
        <?php
            require '../includes/view-users.inc.php';
            require '../includes/delete-user.inc.php';
        ?>
    </div>
</main>

<?php
    require '../footer.php';
?>
