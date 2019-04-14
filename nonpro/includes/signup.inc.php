<?php
//if signup button is clicked
if (isset($_POST['signup-submit'])) {
    //require database connection
    require 'dbh.inc.php';

    //declare variables for each input
    $firstname = $_POST['firstname']; // [inside here is the input name]
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    //check if one of input for form registration is empty
    if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($confirmpassword)) {
        header("Location: ../admin/signup.php?error=emptyfields&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&username=".$username);
        exit();      
    }
    //check if first name or last name has numbers or symbols
    elseif(!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)){
        header("Location: ../admin/signup.php?error=invalidName&email=".$email."&username=".$username);
        exit();
    }
    //check if email and username is valid
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../admin/signup.php?error=invalidEmailandUsername&firstname=".$firstname."&lastname=".$lastname);
        exit();
    }
    //check if email is valid
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../admin/signup.php?error=invalidEmail&username=".$username."&firstname=".$firstname."&lastname=".$lastname);
        exit();
    }
    //check if username is valid
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../admin/signup.php?error=invalidUsername&firstname=".$firstname."&lastname=".$lastname."&email=".$email);
        exit();
    }
    //check if password don't match
    elseif($password !== $confirmpassword) {
        header("Location: ../admin/signup.php?error=passwordcheck&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&username=".$username);
        exit();
    } else {
        //check database if username is available
        $sql = "SELECT * FROM tbl_users WHERE username=?;"; /* '?' is used as placeholder for security */
        /* STMT = Statement and INIT = Initialize */
        $stmt = mysqli_stmt_init($conn);
        //check if can't connect to sql then returns error 'err for sql errors'
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/signup.php?err");
            exit();
        }
        //if all input is good then
        else {
            mysqli_stmt_bind_param($stmt, "s", $username); /* String = s, Integer = i, Blob = b, Double = d  NOTE: if '?' only 1 then 's' only 1 else 'ss', $something, $something2 */
            mysqli_stmt_execute($stmt); /* executes the connection to the databse */
            mysqli_stmt_store_result($stmt); /* fetch information from database and stores it */
            //declare the result got from database
            $resultCheck = mysqli_stmt_num_rows($stmt);
            //check if username is already taken then returns error
            if ($resultCheck > 0) {
                header("Location: ../admin/signup.php?errorr=usertaken");
                exit();
            }
            //if username is available to use then proceed
            else {
                //insert all input to database
                $sql = "INSERT INTO tbl_users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)"; // '?' used as placeholder for security purposes
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../admin/signup.php?err");
                    exit();
                } else {
                    //declare variable to hash password
                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $username, $password);
                    mysqli_stmt_execute($stmt);
                    //SUCCESS SIGNUP
                    header("Location: ../admin/signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    //closes the connection after use for security
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 
//if somehow user access signup without clicking button *FOR SECURITY*
/* redirect back to signup page */
else {
    header("Location: ../admin/signup.php");
    exit();
}