<?php
require '../includes/dbh.inc.php';
$id = $newId;
$sql = "SELECT * FROM tbl_users WHERE id=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin/view-user.php?err");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck > 0) {
        $sql = "DELETE FROM tbl_users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);   
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/view-users.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            header("Location: ../admin/view-users.php?delete=success");
            exit();
        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);