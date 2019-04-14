<?php
$newId = NULL;
if(isset($_GET['id'])){
    $newId = $_GET['id'];
}
if(isset($_POST['edit-submit'])) {
    require 'dbh.inc.php';
    $id = $newId;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
        header("Location: ../admin/view-users.php?invalid");
        exit(); 
    } else {
        $sql = "SELECT * FROM tbl_users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/edit-questions.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) { 
                $sql = "UPDATE tbl_users SET first_name=?, last_name=?, email=?, username=?, password=? WHERE id=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../admin/view-questions.php?err");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $username, $password, $id);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../admin/view-users.php?update=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}