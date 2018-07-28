<?php

session_start();

$newpass=filter_input(INPUT_GET,"newpass");

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
$adminid=$_SESSION["userid"];
$adminname="";
$adminpass="";
$auth="";
$sql = "update oes_login set userpass='$newpass' where userid='$adminid'";

if ($conn->query($sql) === TRUE) {
    echo "Password : ".$newpass;
} else {
    echo "Not Updated";
}


$conn->close();

?>