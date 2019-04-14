<?php

if(isset($_POST['add-submit'])) {
    require 'dbh.inc.php';

    $question = $_POST['question'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $choice4 = $_POST['choice4'];
    $answer = $_POST['answer'];

    if(empty($question) || empty($choice1) || empty($choice2) || empty($choice3) || empty($choice4) || empty($answer)) {
        header("Location: ../admin/home.php?error=emptyfields&question=".$question."&choice1=".$choice1."&choice2=".$choice2."&choice3=".$choice3."&choice4=".$choice4."&answer=".$answer);
        exit();
    } else {
        //check database if question already exist
        $sql = "SELECT * FROM tbl_questions WHERE question=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin/home.php?err");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $question);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ../admin/home.php?error=questionexist");
                exit();
            } else {
                $sql = "INSERT INTO tbl_questions (question, choice1, choice2, choice3, choice4, answer) VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../admin/home.php?err");
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $question, $choice1, $choice2, $choice3, $choice4, $answer);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../admin/home.php?addquestion=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../admin/home.php");
    exit();
}