<?php
    require 'header-admin.php';
    require 'admin.session.php';
?>
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
    <a href="signup.php">Add User</a>
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
    <h1>Add Questions</h1>
    <?php
    if(isset($_GET['addquestion'])) {
        if($_GET['addquestion'] == "success") {
            echo "<p class='text-success'><b><span class='text-success'>&#10003;</span> Question Added!</b></p>";
          }
    } elseif(isset($_GET['error'])) {
        if($_GET['error'] == "questionexist") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Question Already Exist!</b></p>";
        } elseif($_GET['error'] == "emptyfields") {
            echo "<p class='text-danger'><b><span class='text-danger'>X</span> Empty Fields!</b></p>";
        }
    }
    ?>
      <form action="../includes/add.inc.php" method="post">
            <label for="question">Question:</label>
            <br>
            <textarea name="question" cols="100" rows="5"></textarea>
            <br>
            <br>
            <label for="choice1">Choice 1:</label>
            <br>
            <input type="text" name="choice1" size="50"/>
            Is Correct? <input type="radio" name="answer" value="1"/>
            <br>
            <label for="choice2">Choice 2:</label>
            <br>
            <input type="text" name="choice2" size="50"/>
            Is Correct? <input type="radio" name="answer" value="2"/>
            <br>
            <label for="choice3">Choice 3:</label>
            <br>
            <input type="text" name="choice3" size="50"/>
            Is Correct? <input type="radio" name="answer" value="3"/>
            <br>
            <label for="choice4">Choice 4:</label>
            <br>
            <input type="text" name="choice4" size="50"/>
            Is Correct? <input type="radio" name="answer" value="4"/>
            <br>
            <br>
            <input type="submit" name="add-submit" value="Add Question" />
      </form>
    </div>
    </main>
<?php
    require '../footer.php';
?>
