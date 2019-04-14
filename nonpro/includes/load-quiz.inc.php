<?php
if (mysqli_connect_errno()) {
echo "Failed to connect: " . mysqli_connect_error();
}
$sql = "SELECT * FROM tbl_questions ORDER BY RAND();";
$result = mysqli_query($conn, $sql);
$questionCount = 1;

while($row = mysqli_fetch_assoc($result)) {
$id = $row['id'];
$question = $row['question'];
$choice1 = $row['choice1'];
$choice2 = $row['choice2'];
$choice3 = $row['choice3'];
$choice4 = $row['choice4'];
$answer = $row['answer'];

echo "<div id='d$id'>";
echo "<h4>" . $questionCount++ . ". ". $question . "</h4>";
echo "<input type='radio' id='c1' name='c$id' value='1' checked />" . "<label style='font-weight: normal' for='c1'>" . $choice1 . "</label><br/>";
echo "<input type='radio' id='c2' name='c$id' value='2' />" . "<label style='font-weight: normal' for='c2'>" . $choice2 . "</label><br/>";
echo "<input type='radio' id='c3' name='c$id' value='3' />" . "<label style='font-weight: normal' for='c3'>" . $choice3 . "</label><br/>";
echo "<input type='radio' id='c4' name='c$id' value='4' />" . "<label style='font-weight: normal' for='c4'>" . $choice4 . "</label><br/>";
echo "<input type='submit' value='Submit' />";
echo "</div>";
}
mysqli_close($conn);