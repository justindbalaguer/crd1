<?php
$newId = NULL;
if(isset($_GET['id'])){
    $newId = $_GET['id'];
}
if(isset($_POST['edit-submit'])) {
    require 'dbh.inc.php';
    $id = $newId;
    $question = $_POST['question'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $choice4 = $_POST['choice4'];
    $answer = $_POST['answer'];

    if(empty($question) || empty($choice1) || empty($choice2) || empty($choice3) || empty($choice4) || empty($answer)) {
        header("Location: ../admin/view-questions.php?invalid");
        exit(); 
    } else {
        $sql = "SELECT * FROM tbl_questions WHERE id=?;";
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
                $sql = "UPDATE tbl_questions SET question=?, choice1=?, choice2=?, choice3=?, choice4=?, answer=? WHERE id=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../admin/view-questions.php?err");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssssss", $question, $choice1, $choice2, $choice3, $choice4, $answer, $id);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../admin/view-questions.php?update=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}