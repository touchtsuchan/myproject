<meta charset="UTF-8">
<?php
include('config.php');  

$query = "SELECT * FROM category ORDER BY cid asc" or die("Error:" . mysqli_error()); 

$result = mysqli_query($con, $query); 


echo "<table border='1' align='center' width='500'>";

echo "<tr align='center' bgcolor='#CCCCCC'><td>cid</td><td>name</td><td>parent</td></tr>";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["cid"] .  "</td> "; 
  echo "<td>" .$row["name"] .  "</td> ";  
  echo "<td>" .$row["parent"] .  "</td> ";

}
echo "</table>";

mysqli_close($con);
?>