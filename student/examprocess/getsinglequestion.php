<?php

session_start();

if(filter_input(INPUT_GET,"qid")!=null)
{
$questionid=filter_input(INPUT_GET,"qid");
$finalres12="";


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




else
{
    $sql="select * from oes_questionbank where code='$questionid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
    {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $finalres12=$row["question"]."#".$row["option1"]."#".$row["option2"]."#".$row["option3"]."#".$row["option4"]."#".$row["answer"];
    }
}
echo $finalres12;
    ////////////////////////////////////////////////
}

}

?>