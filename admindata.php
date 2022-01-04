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

    $sql="SELECT * FROM taxibooking where refno='$_POST[refno]'"; 
    $query=mysqli_query($conn, $sql);
   
    if($row = mysqli_fetch_array($query))
    {
        $refNo=$_POST['refno'];
        $sql = "UPDATE taxibooking SET unassigned = 0 where refno='$_POST[refno]'";
        $query=mysqli_query($conn, $sql);
        echo "The booking request ", $refNo ," has been properly assigned.";
        
    }
    else
    { 
        echo "No reference number found."; 
    } 
        mysqli_close($conn);
    }
 // if successful database connection
?>

