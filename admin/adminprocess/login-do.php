<?php

session_start();


$username=filter_input(INPUT_GET,"adminid");
$password=filter_input(INPUT_GET,"adminpass");

include '../../connection.php';
//echo "Hello ".$username." and your password ".$password;
//$data=filter_input(INPUT_GET,"data");
//echo "Helloooooo ".$data;

// Create connection
$conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from oes_login where userid='$username' and userpass='$password' and status='active'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    echo "Welcome User <br>" ;
    while($row = $result->fetch_assoc()) {
        $_SESSION["userid"] = $row["userid"];
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
   
    echo "User : ".$row["userid"]."<br>Password : ".$row["userpass"]."<br>Auth : ".$row["usertype"];
   
     
 
        
    }
} else {
    echo "Invalid User";
}


$conn->close();
?>