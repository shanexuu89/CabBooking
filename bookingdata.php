<?php
$servername = "localhost";
$username = "user";
$password = "123456";
$dbname = "taxibooking";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


else{
    $currentDateTime = date("Y-m-d H:i:s");
    $date = $_POST['date'];
    $time = $_POST['time'];
    $PickupTime = $date .' '. $time;
    
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $telno=$_POST['telnumber'];
    $unit=$_POST['unit'];
    $stno=$_POST['stnumber'];
    $stname=$_POST['stname'];
    $suburb=$_POST['suburb'];
    $destsub=$_POST['destsub'];

    $valid = TRUE;
    //validate all the user inputs
    if (empty($_POST['firstname']) || !ctype_alpha($fname)){
      $valid = false;
      echo "Please enter valid first name.<br/>";
    }
    if (empty($_POST['lastname']) || !ctype_alpha($lname)){
      $valid = false;
      echo "Please enter valid last name.<br/>";
    }
    if (empty($_POST['telnumber']) || !is_numeric($telno)){
      $valid = false;
      echo "Please enter valid phone number.<br/>";
    }
    if (empty($_POST['unit']) || !is_numeric($unit)){
      $valid = false;
      echo "Please enter valid unit.<br/>";
    }
    if (empty($_POST['stnumber']) || !is_numeric($stno)){
      $valid = false;
      echo "Please enter valid street number.<br/>";
    }
    if (empty($_POST['stname']) || !preg_match('/^[a-zA-Z .]+$/i', $stname)){
      $valid = false;
      echo "Please enter valid street name.<br/>";
    }
    if (empty($_POST['suburb']) || !preg_match('/^[a-zA-Z .]+$/i', $suburb)){
      $valid = false;
      echo "Please enter valid Suburb.<br/>";
    }
    if (empty($_POST['destsub']) || !preg_match('/^[a-zA-Z .]+$/i', $destsub)){
      $valid = false;
      echo "Please enter valid destination suburb.<br/>";
    }
    if (empty($_POST['date'])){
      $valid = false;
      echo "Please enter your pick-up date.<br/>";
    }
    if (empty($_POST['time'])){
      $valid = false;
      echo "Please enter your pick-up time.<br/>";
    }
    if($currentDateTime >= $PickupTime){
      echo "The pick-up time is no less than current time.<br/>";
    }

    if($valid){
    //insert the user input to the data
    $query = "INSERT INTO taxibooking"
                             ."(fname, lname, telno, unit, stno, stname, suburb, destsub, date, time, unassigned)"
                             . "values"
                             ."('$fname','$lname','$telno', '$unit', '$stno', '$stname', '$suburb', '$destsub', '$date', '$time', true)";
        
    // executes the query
    $result = mysqli_query($conn, $query);
    if($result){
        $sql="SELECT * FROM taxibooking where fname='$_POST[firstname]' && time='$_POST[time]'"; 
        $queryResult=mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($queryResult);
        $refno=$row['refno'];
        $pickupDate=$row['date'];
        $pickupTime=$row['time'];
        echo "Thank you! Your booking reference number is ", $refno  , ". <br/>You will be picked up in front of your provided address at " , $pickupTime ," on " , $pickupDate , ".";
        }
    else{
        echo "something wrong with your data!";
        }
    }
 
        //close the connection
        mysqli_close($conn);
    }
?>
