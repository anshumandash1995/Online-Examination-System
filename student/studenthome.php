<!DOCTYPE html>
<html lang="en">
    <head>
        <title>STUDENT HOME</title>
        <?php
// Start the session
session_start();
?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/buttons.css">
        <link rel="stylesheet" href="../css/jquery.dataTables.css">
    
        
        
        <script type="text/javascript"  src="../script/jquery-hp.js"></script>
        <script type="text/javascript" src="../script/bootstrap.js"></script>
        <script type="text/javascript" src="../script/jquery.noty.packaged1.js"></script>
        <script type="text/javascript" src="../script/notification_html3.js"></script>
        <script type="text/javascript" src="../script/jquery.dataTables.min.js"></script>
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
  max-width:400px;
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
.dropdown-menu a
{
    background-color:#99ccff;
    margin-bottom: 2px;
}
        </style>
        

        <script>
            function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'topCenter',
                closeWith   : ['click'],
                theme       : 'relax',
                maxVisible  : 10,
                animation   : {
                    open  : 'animated bounceInLeft',
                    close : 'animated bounceOutRight',
                    easing: 'swing',
                    speed : 400
                }
            });
            console.log('html: ' + n.options.id);
        }
        function generateLeft(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'topLeft',
                closeWith   : ['click'],
                theme       : 'relax',
                maxVisible  : 10,
                animation   : {
                    open  : 'animated bounceInLeft',
                    close : 'animated bounceOutRight',
                    easing: 'swing',
                    speed : 400
                }
            });
            console.log('html: ' + n.options.id);
        }
            //generate('warning', notification_html[2]);
            //generate('error', notification_html[1]);
            //generate('information', notification_html[0]);
            //generate('success', notification_html[3]);
            //generate('notification');
            //generate('success');
        
       
        $(document).ready(function(){
            
             $('#example').dataTable();
            $("#signoutbtn").click(function(){
                logout(); 
            });
            
            
            $("#changepassBtn").click(function(){
                validateChangePassword();
            });
            
        });
        
        
        
        function logout()
        {
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
            };
        xmlhttp.open("GET","studentprocess/logout-do.php",true);
        xmlhttp.send();
        
        getdata("Signing out in 2 sec..",'');
        generateLeft('error',notification_html[4]);
        setTimeout(function(){window.location.assign("../index.php");},2000);
        
        }
            
            
            
            
            
                
                function validateChangePassword()
        {
            if($("#newpass").val()==="" || $("#newpass").val()===null)
        {
            //alert('Please enter your userid and password');
            getdata("Please enter NEW PASSWORD",'fill before submit');
                generateLeft('error',notification_html[4]);
        }  
        else
        {
            ProcessChangePassword();
               setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="P")
                   {
                       onsucessalert();
                   }
                   else
                   {
                       onerroralert();
                   }
               },1000);
        }
        }
        
        function ProcessChangePassword()
        {
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
            };
        xmlhttp.open("GET","studentprocess/changepassword-do.php?newpass="+$("#newpass").val(),true);
        xmlhttp.send();
        }
        
        
        
        function onsucessalert()
        {
            getdata("Password Changed Successfully",document.getElementById("txtHint").innerHTML);
            generate('success',notification_html[4]);    
            $("#newpass").removeAttr("title");
            $("#newpass").val("");
        }
        
        function onerroralert()
        {
            getdata(document.getElementById("txtHint").innerHTML,'');
            generate('error',notification_html[4]);
        }
        
        
            </script>
    </head>
    
    <body style="background-color: #ebebeb">
        <?php
        
if(isset($_SESSION["suserid"]))
{
    if($_SESSION["suserid"]!="")
    {}
    else
    {
        echo "<script>window.location.assign('../index.php');</script>";
    }
}
else
{
    echo "<script>window.location.assign('../index.php');</script>";
}
        ?>
        <?php

include '../connection.php';
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
$stdid=$_SESSION["suserid"];
$stdname="";
$stdpass="";
$auth="student";
$stdcourse="";
$stdsem="";
$sql = "select * from oes_student where studentid='$stdid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        $stdname=$row["studentname"];
        $stdpass=$row["password"];
        $stdcourse=$row["course"];
        $stdsem=$row["semester"];
    }
} else {
    echo "<script type='text/javascript'>alert('Invalid User');</script>";
}


$conn->close();

?>
        
        
        <h1 class="jumbotron text-center effect2" style="margin:0;padding:20px;margin-bottom:5px;background-color: #00cccc">ONLINE EXAMINATION SYSTEM<small style="color: #666666"><br/>Student</small></h1>
        <div class="container-fluid text-right" style="margin-top:15px;">Hello <kbd><?php echo $stdname; ?>-<?php echo $stdid; ?></kbd><input class="btn btn-warning " type="button" value="Sign Out" id="signoutbtn"></div>
        <div class="container">
            <div id="txtHint" class="btn btn-success btn-block" style="display:none;"><b>Process Status...</b></div>
            <!-------------------------MENU BAR-------------------------->
            <div style="box-shadow:0px 14px 10px -10px #999999;">              
                
      <nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <a class="navbar-brand" href="#">OES</a>
   </div>
   <div>
      <ul class="nav navbar-nav">
         <li class="active"><a href="studenthome.php">Home</a></li>
         
    <li class="">
      <a href="report.php" style="margin-right: 2px;">Previous Exam Reports</a>
    </li>
    
      </ul>
   </div>
</nav>
                
                
                
           </div>
            <!---------------------------------------------->
            <!-------------------------CONTENT SECTION ----------------------->
            <div style="margin:10px 0px;border-radius:5px;">
                
                <div class="col-sm-6" style="box-shadow:0px 10px 10px -10px #999999;margin:10px 0px;background-color: #66ccff;padding:0px;border-radius:10px;">
                    <h4 style="border-top-left-radius:10px;border-top-right-radius:10px;padding:10px 0px;margin-top:0px;box-shadow:0px 2px 2px #999999;background-color: #0099cc;color:whitesmoke;text-align:center;">MY PROFILE</h4>
               <dl class="dl-horizontal" style="margin:10px 0px;padding:0px 10px;">
                   
                   
                   
                   
                   <dt>USER ID :</dt>
                   <dd><?php echo $_SESSION["suserid"];?></dd>
                   <dt>USER NAME :</dt>
                   <dd><?php echo $stdname; ?></dd>
                   <dt>CHNAGE PASS :</dt>
                   <dd><div class="form-horizontal"><div class="col-sm-5 text-right" style="margin:0;padding:0;"><input type="password" id="newpass" class="form-control" placeholder="Enter New Password" title="<?php echo "Current Password : ".$stdpass; ?>"></div><div class="col-sm-5" style="margin:0;padding:0;" ><input type="button" class="form-control btn-success"  value="Change Password" id="changepassBtn"></div></div></dd>
                   <dt>COURSE :</dt>
                   <dd><?php echo $stdcourse; ?></dd>
                   <dt>USER TYPE :</dt>
                   <dd><?php echo $stdsem; ?></dd>
               </dl>
               </div>
                <div style="clear:both;"></div>
            </div>
            <!---------------------------------------------------------------->
            
            <div>
                <!--------------------------------------VIEW ALL EXAM    UPDATE DELETE--------------------------------------->

                <?php
                if(filter_input(INPUT_POST,"updtbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql3 = "update oes_exam_schedule set examdate='".filter_input(INPUT_POST,"cexamdate")."' where id='".filter_input(INPUT_POST,"recordid")."'";

if ($conn->query($sql3) === TRUE) 
{
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-success'>Exam Details Updated</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Updated</div><div style='clear:both;'></div>";
}
echo $sql3;
}


?>










                 <?php
   $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);             
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from oes_exam_schedule where course='$stdcourse' and semester='$stdsem'";
$result = $conn->query($sql);


?>
    <table id="example" class="table span12 table-hover table-bordered">
        <thead>
            <tr class="bg-info">
                <th class="btn-lg">ALL EXAMS</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
            <tr>
            <th>Course</th>
            <th>Semester</th>
            <th>Subject</th>
            <th>Exam Date</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
    ?>
            <tr>
                <td><form action="startexam.php" method="post"><input type="hidden" name="recordid" value="<?php echo $row["id"]; ?>">
                <?php echo $row["course"] ?>
                </td>
                <td><?php echo $row["semester"]; ?></td>
                <td><input type="hidden" name="subjectname" value="<?php echo $row["subject"]; ?>"><?php echo $row["subject"];?></td>
                <td><?php echo $row["examdate"];?>
              <?php
//                  $time = strtotime($row["examdate"]);
//
//                    $newformat = date('Y-m-d',$time);
//
//                    echo $newformat;
//                    
//                    echo "<hr>";
//                    $dt = new DateTime();
//                    echo $dt->format('Y-m-d');
//                    
//                    echo "<hr/>";
//                    if(strtotime($newformat)==  strtotime($dt->format('Y-m-d')))
//                    {
//                        echo "<p class='btn-btn-success btn-block;'>Current</p>";
//                    }
// else {
//                     echo "<p class='btn-btn-danger btn-block;'>Incorrect</p>";
// }
//  ?>
                </td>
                <td><input type="submit" name="updtbtn" 
                           <?php
                  $time = strtotime($row["examdate"]);
                  $newformat = date('Y-m-d',$time);
                  $dt = new DateTime();
                  if(strtotime($newformat)==  strtotime($dt->format('Y-m-d')))
                    {
                        echo "class='form-control btn-primary' value='Start Exam'";
                    }
                    else 
                        {
                     echo "class='form-control btn-danger' value='Not Active' disabled";
                    }
                          ?>
                           
                  ></form></td>
            </tr>
<?php  
}
} 
else {
    echo "0 RECORDS";
}
?>  
    </table>
                
            </div>
<!--            <button onclick="myFunction()">Try it</button>

<script>
function myFunction() {
    window.open("startexam.php", "_blank", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no, width="+screen.width+", height="+screen.height+'"');
    
}
</script>   -->
            
            
            
        </div>
    </body>
</html>