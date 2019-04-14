<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
elseif($_SESSION['admin'] !== 1) {
  header("Location: ../quiz.php");
  exit();
}