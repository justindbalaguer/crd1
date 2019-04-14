<?php
session_start();
require 'includes/dbh.inc.php';

$count_correct=mysqli_real_escape_string($conn,$_POST['count_correct']);
$username=mysqli_real_escape_string($conn,$_SESSION['username']);

$msg=""; $sql="";

$sql="insert into tbl_result values('','$username','$count_correct')";

if($msg==""){
 mysqli_query($conn,$sql);
}

$a['msg']=$msg;
$a['username']=$username;
echo json_encode($a);

?>
