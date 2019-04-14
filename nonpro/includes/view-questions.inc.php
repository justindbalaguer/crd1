<?php
ob_start();
if (mysqli_connect_errno()){
echo "Failed to connect: " . mysqli_connect_error();
}
$sql = "SELECT * FROM tbl_questions";
$result = mysqli_query($conn, $sql);         

echo "<table class='table table-bordered table-hover table-striped' border='1'>
<tr>
<th class='text-center' scope='col'>Questions</th>
<th class='text-center' scope='col'>Choice 1</th>
<th class='text-center' scope='col'>Choice 2</th>
<th class='text-center' scope='col'>Choice 3</th>
<th class='text-center' scope='col'>Choice 4</th>
<th class='text-center' scope='col'>Answer</th>
<th class='text-center' scope='col' colspan='2'>Action</th>
</tr>";

while($row = mysqli_fetch_array($result)){
$id = $row['id'];
$question = $row['question'];
$choice1 = $row['choice1'];
$choice2 = $row['choice2'];
$choice3 = $row['choice3'];
$choice4 = $row['choice4'];
$answer = $row['answer'];
echo "<tr>";
echo "<td>" . $question . "</td>";
echo "<td>" . $choice1 . "</td>";
echo "<td>" . $choice2 . "</td>";
echo "<td>" . $choice3 . "</td>";
echo "<td>" . $choice4 . "</td>";
echo "<td class='text-center'>" . $answer . "</td>";
echo "<td class='text-center'><a href='edit-questions.php?id=$id'>Edit</a></td>";
echo "<td class='text-center'><a href= '#' class='clickedClass'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo "        <script>
        var elements = document.getElementsByTagName('a'); 
for(var i=0; i<elements.length; i++){
if (elements[i].className == 'clickedClass') { 
        elements[i].onclick = function(){ 
        var a = confirm('Are you sure?');
            if (a == true) { 
                location.href = 'view-questions.php?id=$id'; 
            } else {
            }
}
} 
}
    </script>";
mysqli_close($conn);