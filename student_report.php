<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Report</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/buttons.css">
        
        
        
        <script type="text/javascript"  src="script/jquery-hp.js"></script>
        <script type="text/javascript" src="script/bootstrap.js"></script>
        <script type="text/javascript" src="script/jquery.noty.packaged1.js"></script>
        <script type="text/javascript" src="script/notification_html3.js"></script>
       

        
        
        
        
        
        <style>
            .effect2
{
  position: relative;
  margin-bottom:10px;
  background-color: white;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 10px;
  left: 10px;
  width: 70%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}
        </style>
        
        <script>
        
        $(document).ready(function(){
            
            $("#printbtn").click(function(){
                $("#printbtn").css("display","none");
                window.print();
            });
        });
            </script>
    </head>
    <body class="bg-info">
        
        <!--------------------------HEADER---------------------------------->
       <h1 class="jumbotron text-center  effect2" style="margin:0;padding:20px;margin-bottom:5px;">ONLINE EXAMINATION SYSTEM<small><br/>STUDENT PERFORMANCE REPORT</small></h1>
        
       <!---------------------------BODY SECTION------------------------------>
       
       
       
<?php
include './connection.php';

if(filter_input(INPUT_POST,"reportbtn")!=NULL)
{
$sql = "select * from oes_exam_result where studentid='".filter_input(INPUT_POST,"oldsid")."' and subject='".filter_input(INPUT_POST,"oldsubject")."'";
$conn = new mysqli($servername, $dbuname, $dbupass, $dbname);             
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) 
    {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
    
?>
       
       
       
       
       <div class="container effect2" style="height:300px;background-color: #ffffcc;box-shadow:0px 30px 30px -30px black;">
           <div class="row">
               <div class="col-sm-3">
                   <img src="image/user.png" class="img img-responsive img-circle">
               </div>
               <div class="col-sm-9">
                   <table class="table table-responsive table-bordered" style="margin-top:10px;">
                       <tr>
                           <td style="width:20%;" class="text-right">STUDENT ID :</td>
                           <td><?php echo $row["studentid"]; ?></td></tr>
                           <tr>
                           <td style="width:20%;" class="text-right">STUDENT NAME :</td>
                           <td><?php echo $row["studentname"]; ?></td></tr>
                           <tr>
                            <tr>
                           <td style="width:20%;" class="text-right">COURSE :</td>
                           <td><?php echo $row["course"]; ?></td></tr>
                           <tr>   
                               
                           <td style="width:20%;" class="text-right">SEMESTER :</td>
                           <td><?php echo $row["semester"]; ?></td></tr>
                           <tr>
                           <td style="width:20%;" class="text-right">SUBJECT :</td>
                           <td><?php echo $row["subject"]; ?></td></tr>
                           <tr>
                           <td style="width:20%;" class="text-right">EXAM DATE</td>
                           <td><?php echo $row["examdate"]; ?></td></tr>
                           <tr>
                           <td style="width:20%;" class="text-right">TOTAL MARKS SECURED :</td>
                           <td><?php echo $row["totalmark"]; ?></td>
                       </tr>
                   </table>
               </div>
               <div style="clear:both"></div> 
           </div>
           <div style="clear:both"></div> 
       </div>
           
           
  
       
       <?php
         }
} 
else {
    echo "0 results";
}
}
?>         
       
           
           
           
       <div class="col-sm-2 col-sm-offset-5"><button class="btn btn-primary btn-block" id="printbtn">PRINT REPORT</button></div>
    </body>
</html>