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
    <title>Edit Questions</title>
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
              <!--Add Users Link-->
              <div class="container">
    <a href="signup.php">Add Users</a>
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
    <h1>Edit Questions</h1>
    <?php require '../includes/edit-questions-load.inc.php';?>
      <form action="../includes/edit-questions.inc.php?id=<?php echo $newId;?>" method="post">
            <label for="question">Question:</label>
            <br>
            <textarea name="question" cols="100" rows="5"><?php echo $_SESSION['question'];?></textarea>
            <br>
            <br>
            <label for="choice1">Choice 1:</label>
            <br>
            <input type="text" name="choice1" size="50" value="<?php echo $_SESSION['choice1'];?>"/>
            Is Correct? <input type="radio" name="answer" value="1" <?php echo $_SESSION['answer'] == "1" ? "checked" : "";?> />
            <br>
            <label for="choice2">Choice 2:</label>
            <br>
            <input type="text" name="choice2" size="50" value="<?php echo $_SESSION['choice2'];?>"/>
            Is Correct? <input type="radio" name="answer" value="2" <?php echo $_SESSION['answer'] == "2" ? "checked" : "";?>/>
            <br>
            <label for="choice3">Choice 3:</label>
            <br>
            <input type="text" name="choice3" size="50" value="<?php echo $_SESSION['choice3'];?>"/>
            Is Correct? <input type="radio" name="answer" value="3" <?php echo $_SESSION['answer'] == "3" ? "checked" : "";?>/>
            <br>
            <label for="choice4">Choice 4:</label>
            <br>
            <input type="text" name="choice4" size="50" value="<?php echo $_SESSION['choice4'];?>"/>
            Is Correct? <input type="radio" name="answer" value="4" <?php echo $_SESSION['answer'] == "4" ? "checked" : "";?>/>
            <br>
            <br>
            <input type="submit" name="edit-submit" value="Update" />
            <br>
            <br>
      </form>
    </div>
    </main>

<?php
    require '../footer.php';
?>
