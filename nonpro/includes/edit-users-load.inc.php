<?php
require '../includes/dbh.inc.php';
$id = $newId;

$sql = "SELECT * FROM tbl_users WHERE id=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin/view-users.php?err");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck > 0) {
        $sql = "SELECT * FROM tbl_users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);   
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/edit-users.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $idCheck = $row['id'];
                if ($idCheck == $id) {
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}