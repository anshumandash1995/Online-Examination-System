<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ADMIN HOME</title>
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
$adminid=$_SESSION["userid"];
$adminname="";
$adminpass="";
$auth="";
$sql1 = "select * from oes_login where userid='$adminid'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    
    while($row1 = $result1->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        $adminname=$row1["username"];
        $adminpass=$row1["userpass"];
        $auth=$row1["usertype"];
    }
} else {
    echo "<script type='text/javascript'>alert('Invalid User');</script>";
}


$conn->close();

?>
        
        
        <h1  class="jumbotron text-center effect2" style="margin:0;padding:20px;margin-bottom:5px;background-color: #009999">ONLINE EXAMINATION SYSTEM<small style="color: #666666"><br/>Administrator</small></h1>
        <div class="container-fluid text-right" style="margin-top:15px;">Hello <kbd><?php echo $adminname; ?></kbd><input class="btn btn-warning " type="button" value="Sign Out" id="signoutbtn"></div>
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
         <li class=""><a href="adminhome.php">Home</a></li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               Manage User 
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="employee.php">Manage Examiner</a></li>
        <li><a href="student.php">Manage Student</a></li>
        <li><a href="employee.php">Add New Examiner</a></li>
        <li><a href="student.php">Add New Student</a></li>
            </ul>
         </li>
         <li class="active">
      <a href="subject.php" style="margin-right: 2px;">Manage Subject</a>
    </li>
    <li class="">
      <a href="exam.php" style="margin-right: 2px;">Create/Manage Exam Schedule</a>
    </li>
    <li class="">
      <a href="exam_result.php" style="margin-right: 2px;">Exam Status/Report</a>
    </li>
      </ul>
   </div>
</nav>
                
                
                
           </div>
            <!---------------------------------------------->
            <!-------------------------CONTENT SECTION ----------------------->
            <div class="" style="background-color: #ffffff;height:300px;">
                
                
                
                
                
                
                <?php
                if(filter_input(INPUT_POST,"addbtn")!=NULL && filter_input(INPUT_POST,"newcourse")!="select Course")
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql3 = "insert into oes_subject(course,semester,subject) values('".filter_input(INPUT_POST,"newcourse")."','".filter_input(INPUT_POST,"newsemester")."','".filter_input(INPUT_POST,"newsubject")."')";

if ($conn->query($sql3) === TRUE) 
{
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-success'>New Subject Created</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Added</div><div style='clear:both;'></div>";
}

}
?>
                
                
                
                
                
                
                <?php
                if(filter_input(INPUT_POST,"updtbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql3 = "update oes_subject set course='".filter_input(INPUT_POST,"course")."',semester='".filter_input(INPUT_POST,"semester")."',subject='".filter_input(INPUT_POST,"subject")."' where code='".filter_input(INPUT_POST,"code")."'";

if ($conn->query($sql3) === TRUE) 
{
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-success'>Subject Details Updated</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Updated</div><div style='clear:both;'></div>";
}

}
?>
<!--------------------------------------ADD NEW EXAMINER--------------------------------------->



                <div>
                <table class="table span12 table-responsive table-stripped">
                    <tr class="bg-success">
                <th class="btn-lg">Add New Subject</th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
            <tr>
                <td><form action="subject.php" method="post"><select name="newcourse" class="form-control"><option>select Course</option><option>B.Tech</option><option>MCA</option></select></td>
            <td><select name="newsemester" class="form-control"><option>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option></select></td>
            <td><input type="text" name="newsubject" required="" placeholder="Subject Name" class="form-control"></td>
            <td><input type="submit" value="Add Record" name="addbtn" class="form-control btn-success"></form></td> 
            </tr>
                </table>
    </div>

<!--------------------------------------VIEW ALL EXAMINER--------------------------------------->
                 <?php
   $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);             
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from oes_subject";
$result = $conn->query($sql);


?>
    <table id="example" class="table span12 table-hover">
        <thead>
            <tr class="bg-info">
                <th class="btn-lg">All Student Records</th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
            <tr>
            <th>Course</th>
            <th>Semester</th>
            <th>Subject</th>
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
                <td><form action="subject.php" method="post"><input type="hidden" name="code" value="<?php echo $row["code"]; ?>">
                        <select name="course" class="form-control"><?php 
                
                if($row["course"]=="B.Tech")
                {
                    echo "<option selected>B.Tech</option><option>MCA</option>";
                }
 if($row["course"]=="MCA") {
    echo "<option>B.Tech</option><option selected>MCA</option>"; 
 }   ?> 
                    </select>
                </td>
                
                
                
                <td><select name="semester" class="form-control"><?php 
                
                switch($row["semester"])
                {
                    case "Semester 1":
                        echo "<option selected>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 2":
                        echo "<option>Semester 1</option><option selected>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 3":
                        echo "<option>Semester 1</option><option>Semester 2</option><option selected>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 4":
                        echo "<option>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option selected>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 5":
                        echo "<option>Semester 1</option><option >Semester 2</option><option>Semester 3</option><option>Semester 4</option><option selected>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 6":
                        echo "<option>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option selected>Semester 6</option><option>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 7":
                        echo "<option>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option selected>Semester 7</option><option>Semester 8</option>";
                        break;
                    case "Semester 8":
                        echo "<option>Semester 1</option><option>Semester 2</option><option>Semester 3</option><option>Semester 4</option><option>Semester 5</option><option>Semester 6</option><option>Semester 7</option><option selected>Semester 8</option>";
                        break;
                }              
 ?> 
                    </select>
                </td>
                
                
                
                
                
                <td>
                   <input type="text" name="subject" class="form-control" value="<?php echo $row["subject"]; ?>"> 
                </td>
                
                
                
                
                
                <td><input type="submit" class="form-control btn-warning" name="updtbtn" value="UPDATE SUBJECT"></form></td>
            </tr>
<?php  
}
} 
else {
    echo "0 results";
}
?>  
    </table>
            </div>
        </div>
    </body>
</html>