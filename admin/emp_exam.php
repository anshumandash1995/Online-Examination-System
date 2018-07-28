<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EMPLOYEE HOME</title>
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
            $("#signoutbtn").click(function(){
                logout(); 
            });
            
            
            $("#changepassBtn").click(function(){
                validateChangePassword();
            });
             $('#example').dataTable();
            $("#signoutbtn").click(function(){
                logout(); 
            });
            
            $("#newsub1").change(function(){
                if($("#newsub1").val()==="--Select Sub--")
                {
                    
                     $("#addbtn").attr("disabled","true");
                     $("#addbtn").removeClass("btn-primary");
                }
                else
                {
                    $("#addbtn").removeAttr("disabled");
                     $("#addbtn").addClass("btn-primary"); 
                    
                }
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
         <li class=""><a href="employeehome.php">Home</a></li>
         
    <li class="active">
      <a href="emp_exam.php" style="margin-right: 2px;">Create Exam Schedule</a>
    </li>
    
    <li class="">
      <a href="emp_question.php" style="margin-right: 2px;">Question Bank</a>
    </li>
    <li class="">
      <a href="search_student.php" style="margin-right: 2px;">Search students</a>
    </li>
      </ul>
   </div>
</nav>
                
                
                
           </div>
            <!---------------------------------------------->
            <!-------------------------CONTENT SECTION ----------------------->
            <div class="" style="background-color: #ffffff;height:300px;">
                
                
                
                
                
                
                <?php
                
                 $val="-";
                 $val1="-";
                if(filter_input(INPUT_POST,"addbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql3 = "insert into oes_exam_schedule(course,semester,subject,examdate,scheduledbyid,scheduledbyname) values('".filter_input(INPUT_POST,"newcourse")."','".filter_input(INPUT_POST,"newsem")."','".filter_input(INPUT_POST,"newsub")."','".filter_input(INPUT_POST,"newexamdate")."','".filter_input(INPUT_POST,"newsid")."','".filter_input(INPUT_POST,"newsname")."')";

if ($conn->query($sql3) === TRUE) 
{
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-success'>New Exam Scheduled</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Added</div><div style='clear:both;'></div>";
}

}
else
{
    
   
                            if(filter_input(INPUT_POST,"newsem") || filter_input(INPUT_POST,"newcourse"))
                            {
                                $val=filter_input(INPUT_POST,"newsem");
                                $val1=filter_input(INPUT_POST,"newcourse");
                            }
                            else
                            {
                                $val="-";
                                $val1="-";
                            }
                           
}
?>
                
                
                
                
                
                

<!--------------------------------------ADD NEW EXAMINER--------------------------------------->



                <div>
                <table class="table span12 table-responsive table-stripped">
                    <tr class="bg-success">
                <th class="btn-lg">Schedule New Exam</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
            <tr>
                <td><form action="emp_exam.php" method="post">
                         
                        <div class="form-group">
                            <span class="control-lable">Course</span>
                            <select class="form-control" name="newcourse" onchange="this.form.submit();">
                                <option <?php if($val1=="B.Tech") echo "selected"; ?>>B.Tech</option>
                                <option <?php if($val1=="MCA") echo "selected"; ?>>MCA</option></select>
                        </div>
                </td>
                
                
                <td>
                     <div class="form-group">
                            <span class="control-lable">Semester</span>
                           
                            <select class="form-control" name="newsem" onchange="this.form.submit();">
                                <option>--Select Semester--</option>
                                <option <?php if($val=="Semester 1") echo "selected"; ?> >Semester 1</option>
                                <option <?php if($val=="Semester 2") echo "selected"; ?> >Semester 2</option>
                                <option <?php if($val=="Semester 3") echo "selected"; ?> >Semester 3</option>
                                <option <?php if($val=="Semester 4") echo "selected"; ?> >Semester 4</option>
                                <option <?php if($val=="Semester 5") echo "selected"; ?> >Semester 5</option>
                                <option <?php if($val=="Semester 6") echo "selected"; ?> >Semester 6</option>
                                <option <?php if($val=="Semester 7") echo "selected"; ?> >Semester 7</option>
                                <option <?php if($val=="Semester 8") echo "selected"; ?> >Semester 8</option>
                            </select>
                            
                            
                        </div>
                    
                </td>
                
                
                
                <td>
                     <div class="form-group">
                            <span class="control-lable">Subject</span>
                            <select class="form-control" id="newsub1" name="newsub">
                                <?php
                                if(filter_input(INPUT_POST,"addbtn")!=NULL)
                                {
                                    echo "<option>--Select Sub--</option>";
                                    
                                }
                                else
                                {
                                    
                                    
                              
                                
                                
                                 if(filter_input(INPUT_POST,"newsem") || filter_input(INPUT_POST,"newcourse"))
                                 {
                                $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "select * from oes_subject where course='$val1' and semester='$val'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    echo "<option>--Select Sub--</option>";
    while($row = $result2->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        
        echo "<option>".$row["subject"]."</option>";
    }
} else
{
    echo "<option>--Select Sub--</option>";
}
                                 }
                                   }
?>
                            </select>
                            
                        </div>
                </td>
                <td>
                     <div class="form-group">
                            <span class="control-lable">Exam Date</span>
                            <input type="date" id="dateselector" name="newexamdate" class="form-control" required="">
                        </div>
                </td>
                <td>
                     <div class="form-group">
                            <span class="control-lable">Scheduler[ID]</span>
                            <input type="text" class="form-control" name="newsid" placeholder="Enter scheduler ID Here" readonly="" value="<?php echo $empid; ?>">
                        </div>
                </td>
                <td>
                     <div class="form-group">
                            <span class="control-lable">Scheduler[Name]</span>
                            <input type="text" class="form-control" name="newsname" placeholder="Enter scheduler name Here"  readonly="" value="<?php echo $empname; ?>">
                        </div>
                </td>
                <td>
                     <div class="form-group">
                            <span class="control-lable">Action</span>
                            <input type="submit" class="form-control" value="Schedule Exam" id="addbtn" name="addbtn" disabled="">
                     </div></form>
                </td>
            </tr>
                </table>
    </div>

<!--------------------------------------VIEW ALL EXAMINER--------------------------------------->

<?php
   $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);             
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from oes_exam_schedule";
$result = $conn->query($sql);


?>
    <table id="example" class="table span12 table-hover">
        <thead>
            <tr class="bg-info">
                <th class="btn-lg">Scheduled Exam</th>
            <th></th>
            <th></th>
            <th></th><th></th><th></th>
            </tr>
            <tr>
            <th>Course</th>
            <th>Semester</th>
            <th>Subject</th>
            <th>Exam Date</th>
            <th>By ID</th>
            <th>By Name</th>
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
                <td><?php echo $row["course"] ?></td>
                <td> <?php echo $row["semester"]; ?></td>
                <td><?php echo $row["subject"];?></td>
                <td><?php echo $row["examdate"]; ?></td>
                <td> <?php echo $row["scheduledbyid"]; ?> </td>
                <td> <?php echo $row["scheduledbyname"]; ?></td>
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