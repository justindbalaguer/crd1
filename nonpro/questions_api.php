<?php
require 'includes/dbh.inc.php';

?>

<?php
if (mysqli_connect_errno()) {
echo "Failed to connect: " . mysqli_connect_error();
}
$sql = "SELECT * FROM tbl_questions ORDER BY RAND();";
$result = mysqli_query($conn, $sql);
$questionCount = 1;

$ar=array();
$z=0;


while($row = mysqli_fetch_assoc($result)) {

$ar[$z]=array(
'id'=>$row['id'],
'question'=>$row['question'],
'choice1'=>$row['choice1'],
'choice2' => $row['choice2'],
'choice3' => $row['choice3'],
'choice4' => $row['choice4'],
'answer' => $row['answer']

	);

$z+=1;

}




echo json_encode($ar);



mysqli_close($conn);