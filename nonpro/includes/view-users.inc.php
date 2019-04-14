<?php
ob_start();
if (mysqli_connect_errno())
{
echo "Failed to connect: " . mysqli_connect_error();
}
$sql = "SELECT * FROM tbl_users";
$result = mysqli_query($conn, $sql);

echo "<table class='table table-bordered table-hover table-striped table-responsive' border='1'>
<tr>
<th class='text-center' scope='col'>First Name</th>
<th class='text-center' scope='col'>Last Name</th>
<th class='text-center' scope='col'>Email</th>
<th class='text-center' scope='col'>Username</th>
<th class='text-center' scope='col'>Password</th>
<th class='text-center' scope='col' colspan='2'>Action</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
$id = $row['id'];
echo "<tr>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td class='text-center'><a href='edit-users.php?id=$id'>Edit</a></td>";
echo "<td class='text-center'><a href='#' class='clickedClass'>Delete</a></td>";
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
                location.href = 'view-users.php?id=$id'; 
            } else {
            }
}
} 
}
    </script>";
mysqli_close($conn);