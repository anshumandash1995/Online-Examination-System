<?php

session_start();
$data="";
if(filter_input(INPUT_GET,"sid")!=null)
{
$studentid=filter_input(INPUT_GET,"sid");
$studentsubject=filter_input(INPUT_GET,"subject");
$mark=filter_input(INPUT_GET,"mark");

include '../../connection.php';

// Create connection
$conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection

$sql = "update oes_exam_result set totalmark='$mark',examstatus='closed' where studentid='$studentid' and subject='$studentsubject'";
$data=$sql;
if ($conn->connect_error) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
else
{
if ($conn->query($sql) === TRUE)
{
   echo "SuccessYour Result Submitted";
} 
else
{
    echo "Error!! <br />Unable to Send Data. ";
}
}

$conn->close();
}



?>