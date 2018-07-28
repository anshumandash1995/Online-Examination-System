<?php

session_start();


$username=filter_input(INPUT_GET,"studentid");
$password=filter_input(INPUT_GET,"studentpass");

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

$sql = "select * from oes_student where studentid='$username' and password='$password' and status='active'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    echo "Welcome User <br>" ;
    while($row = $result->fetch_assoc()) {
        $_SESSION["suserid"] = $row["studentid"];
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        echo "User : ".$row["studentid"]."<br>Password : ".$row["password"]."<br>Auth : student";
    }
} else {
    echo "Invalid User";
}


$conn->close();

?>