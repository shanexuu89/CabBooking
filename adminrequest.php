<link rel="stylesheet" type="text/css" href= "admin.css" />
<?php

$servername = "localhost";
$username = "user";
$password = "123456";
$dbname = "taxibooking";
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

else
    {
   
    $sql = "SELECT * FROM taxibooking WHERE unassigned = 1"; 
    $query=mysqli_query($conn, $sql);
    
  
    echo "<table class='content-table'>";
      echo "<thead>";
        echo "<tr>";
           echo "<td>Reference Number</td>";
           echo "<td>First Name</td>";
           echo "<td>Last Name</td>";
           echo "<td>Phone Number</td>";
           echo "<td>Pick-up Suburb</td>";
           echo "<td>Destination Suburb</td>";
           echo "<td>Pick-up Date</td>";
           echo "<td>Pick-up Time</td>";
        echo "</tr>";
      echo "</thead>";
     echo "<tbody>";
    while ($row = mysqli_fetch_assoc($query)){
				
         echo "<tr>";
           echo "<td>". $row["refno"]. "</td>";
           echo "<td>". $row["fname"]. "</td>";
           echo "<td>". $row["lname"]. "</td>";
           echo "<td>". $row["telno"]. "</td>";
           echo "<td>". $row["suburb"]. "</td>";
           echo "<td>". $row["destsub"]. "</td>";
           echo "<td>". $row["date"]. "</td>";
           echo "<td>". $row["time"]. "</td>";
        echo "</tr>";      
    }
     echo "</tbody>";
    echo "</table>";


        mysqli_close($conn);
    }
 // if successful database connection
?>

