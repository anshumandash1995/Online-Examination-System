<?php

session_start();

if(filter_input(INPUT_GET,"sid")!=null)
{
$studentid=filter_input(INPUT_GET,"sid");
$studentname=filter_input(INPUT_GET,"sname");
$studentcourse=filter_input(INPUT_GET,"scourse");
$studentsemester=filter_input(INPUT_GET,"semester");
$studentsubject=filter_input(INPUT_GET,"subject");
$dt = new DateTime();
$examdate= $dt->format('Y-m-d');

$examtime=filter_input(INPUT_GET,"rtime");
$randomid="";



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


$sql3 = "insert into oes_exam_result values('$studentid','$studentname','$studentcourse','$studentsemester','$studentsubject','$examdate','$examtime',0,'appeared')";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($sql3) === TRUE) 
{
   
} 
else
{
    echo "Error!! <br />Seems like you have already appeared exam.";
    die("Contact to examiner<br />Redirecting to home page in 5sec");
}


$sql = "select * from oes_questionbank where subject='$studentsubject' order by rand() limit 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $randomid=$randomid.$row["code"]."@";
    }
} else {

}




$conn->close();


echo "Success".$randomid;

}
else
{
    echo "Error Data Cathing";
}



?>