<?php
require '../includes/dbh.inc.php';
$id = $newId;

$sql = "SELECT * FROM tbl_questions WHERE id=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin/viewquestions.php?err");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck > 0) {
        $sql = "SELECT * FROM tbl_questions WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);   
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/edit-questions.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $idCheck = $row['id'];
                if ($idCheck == $id) {
                    $_SESSION['question'] = $row['question'];
                    $_SESSION['choice1'] = $row['choice1'];
                    $_SESSION['choice2'] = $row['choice2'];
                    $_SESSION['choice3'] = $row['choice3'];
                    $_SESSION['choice4'] = $row['choice4'];
                    $_SESSION['answer'] = $row['answer'];
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}