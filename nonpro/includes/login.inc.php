<?php
//if login button is clicked
if(isset($_POST['login-submit'])) {
    //require database connection
    require 'dbh.inc.php';

    //declare variables for user input
    $usernameemail = $_POST['usernameemail'];
    $password = $_POST['password'];

    //check if fields are empty
    if(empty($usernameemail) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&usernameemail=".$usernameemail);
        exit();
    }
    //if fields are not empty then
    else {
        //check database if username or email is found
        $sql = "SELECT * FROM tbl_users WHERE username=? OR email=? AND password=?;";
        //for comments explaining see signup.inc.php
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $usernameemail, $usernameemail, $password); //CHECK LATER IF WORKING
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordcheck = $row['password'];
                $admincheck = $row['admin'];
                if($passwordcheck !== $password) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                elseif (($passwordcheck == $password) && ($admincheck == 0)) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['admin'] = $row['admin'];
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['lastname'] = $row['last_name'];
                    $_SESSION['emai'] = $row['email'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../quiz.php?login=success");
                    exit();
                }
                elseif (($passwordcheck == $password) && ($admincheck == 1)) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['admin'] = $row['admin'];
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['lastname'] = $row['last_name'];
                    $_SESSION['emai'] = $row['email'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../admin/home.php?login=success");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}