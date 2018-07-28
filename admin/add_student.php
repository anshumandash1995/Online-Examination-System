<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EMPLOYEE STUDENT ADD</title>
        <?php
// Start the session
session_start();
?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/buttons.css">
        
        
        
        <script type="text/javascript"  src="../script/jquery-hp.js"></script>
        <script type="text/javascript" src="../script/bootstrap.js"></script>
        <script type="text/javascript" src="../script/jquery.noty.packaged1.js"></script>
        <script type="text/javascript" src="../script/notification_html3.js"></script>
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
        xmlhttp.open("GET","adminprocess/logout-do.php",true);
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
        xmlhttp.open("GET","adminprocess/changepassword-do.php?newpass="+$("#newpass").val(),true);
        xmlhttp.send();
        }
        
        
        
        function onsucessalert()
        {
            getdata("Password Changed Successfully",document.getElementById("txtHint").innerHTML);
            generate('success',notification_html[4]);    
            $("#newpass").removeAttr("title");
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
        
if(isset($_SESSION["userid"]))
{
    if($_SESSION["userid"]!="")
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
$empid=$_SESSION["userid"];
$empname="";
$emppass="";
$auth="";
$sql = "select * from oes_login where userid='$empid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        $empname=$row["username"];
        $emppass=$row["userpass"];
        $auth=$row["usertype"];
    }
} else {
    echo "<script type='text/javascript'>alert('Invalid User');</script>";
}


$conn->close();

?>
        
        
        <h1 class="jumbotron text-center effect2" style="margin:0;padding:20px;margin-bottom:5px;background-color: #00cccc">ONLINE EXAMINATION SYSTEM<small style="color: #666666"><br/>Employee</small></h1>
        <div class="container-fluid text-right" style="margin-top:15px;">Hello <kbd><?php echo $empname; ?></kbd><input class="btn btn-warning " type="button" value="Sign Out" id="signoutbtn"></div>
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
	  </ul>
         <ul class="nav navbar-nav">
         <li class="active"><a href="employeehome.php">Home</a></li>
         
    <li class="">
      <a href="emp_exam.php" style="margin-right: 2px;">Create Exam Schedule</a>
    </li>
    
    <li class="">
      <a href="emp_question.php" style="margin-right: 2px;">Question Bank</a>
    </li>
      
    <li >
      <a href="add_student.php" style="margin-right: 2px;">Add new student</a>
    </li>
    <li class="active">
      <a href="search_student.php" style="margin-right: 2px;">Search students</a>
    </li>
      
    </li>
      </ul>
   </div>
</nav>
                
                
                
           <div style="margin:10px 0px;border-radius:5px;">
                
                <div class="col-sm-6" style="box-shadow:0px 10px 10px -10px #999999;margin:10px 0px;background-color: #66ccff;padding:0px;border-radius:10px;">
                    <h4 style="border-top-left-radius:10px;border-top-right-radius:10px;padding:10px 0px;margin-top:0px;box-shadow:0px 2px 2px #999999;background-color: #0099cc;color:whitesmoke;text-align:center;">Add New Student</h4>
               <dl class="dl-horizontal" style="margin:10px 0px;padding:0px 10px;">
                   <h3 style="text-align: center;">Instructions<br></h3>
                   <ol>
                     <li>Click Generate code to generate an Unique code.</li>
                     <li>Copy that Id and paste in the code box.</li>
                     <li>Enter the ID you wish to give your student.</li>
                     <li>Hit submit to register the student.</li>
                     <li>Keep the code safe and hand it over to the student along with the ID.</li>
                     <li>The student must register himself/ herself with the code and ID to log in.<br><br><br><br></li>
                   </ol>

            
                   <button type="button" class="btn btn-success" type="submit" name="generate" onclick="generate()">Generate code</button>
                   <h3 id="demo"></h2>
                <script>
                function generate() {
                document.getElementById("demo").innerHTML = "<?php 

                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
                echo $password = substr( str_shuffle( $chars ), 0, 12);

                ?><br><br><span style='font-size: 20px; color:red;'>* Please copy this code now and keep it safe</span>";

                                     }
                </script>
                   <form action="add_student.php" method="post">
                     <fieldset class="form-group">
    <label for="exampleInputEmail1">Student ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter ID" maxlength="50" name="std_id">
    <small class="text-muted">P.S - Hand over this ID to the student.</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="exampleInputEmail1">Generated Code</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter code" maxlength="12" name="std_code">
    <small class="text-muted">P.S - Hand over this code to the student.</small>
  </fieldset>

  <button type="submit" name="studreg" class="btn btn-primary">Submit</button>

                   </form>
               </div>
                <div style="clear:both;"></div>
            </div>
    </body>
</html>

<?php 
include 'database.php';
if (isset($_POST['studreg'])) {
  $std_id = $_POST['std_id'];
  $std_code = $_POST['std_code'];

  if ($std_id=="" OR $std_code=="") {
  echo "<h3 style='color: red'>*Please fill in all the fields</h3>";
}
else{
  $insert_reg = "insert into studentreg (std_code,stdreg_user) values ('$std_code','$std_id')";
  $add_reg = mysql_query($insert_reg);

  echo "<script>alert('Your request has been successfully submited !')</script>";
  echo "<script>window.open('add_student.php','_self')</script>";

}


}
?>