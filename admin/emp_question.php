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
         
    <li class="">
      <a href="emp_exam.php" style="margin-right: 2px;">Create Exam Schedule</a>
    </li>
    
    <li class="active">
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
            <div class="" style="background-color: #ffffff;">
                
                
                
                
                
                
                <?php
                if(filter_input(INPUT_POST,"addbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql3 = "insert into oes_questionbank(subject,question,option1,option2,option3,option4,answer) values('".filter_input(INPUT_POST,"newsub")."','".str_replace("'","''",filter_input(INPUT_POST,"newques"))."','".str_replace("'","''",filter_input(INPUT_POST,"newoption1"))."','".str_replace("'","''",filter_input(INPUT_POST,"newoption2"))."','".str_replace("'","''",filter_input(INPUT_POST,"newoption3"))."','".str_replace("'","''",filter_input(INPUT_POST,"newoption4"))."','".str_replace("'","''",filter_input(INPUT_POST,"newans"))."')";

if ($conn->query($sql3) === TRUE) 
{
    echo "<div class='col-sm-6 col-sm-offset-3 btn btn-success'>New Question Added to Questionbank</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Added</div><div style='clear:both;'></div>";
}

}






if(filter_input(INPUT_POST,"updtbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql4 = "update oes_questionbank set question='".str_replace("'","''",filter_input(INPUT_POST,"oldques"))."',option1='".str_replace("'","''",filter_input(INPUT_POST,"oldoption1"))."',option2='".str_replace("'","''",filter_input(INPUT_POST,"oldoption2"))."',option3='".str_replace("'","''",filter_input(INPUT_POST,"oldoption3"))."',option4='".str_replace("'","''",filter_input(INPUT_POST,"oldoption4"))."',answer='".str_replace("'","''",filter_input(INPUT_POST,"oldans"))."' where code='".filter_input(INPUT_POST,"oldcode")."'";

if ($conn->query($sql4) === TRUE) 
{
    echo "<div class='col-sm-6 col-sm-offset-3 btn btn-warning'>Question Updated</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Updated</div><div style='clear:both;'></div>";
}

}



if(filter_input(INPUT_POST,"delbtn")!=NULL)
                {
                    $conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql4 = "delete from oes_questionbank where code='".filter_input(INPUT_POST,"oldcode")."'";

if ($conn->query($sql4) === TRUE) 
{
    echo "<div class='col-sm-6 col-sm-offset-3 btn btn-warning'>Question Deleted</div><div style='clear:both;'></div>";
} 
else {
    echo "<div class='col-sm-4 col-sm-offset-4 btn btn-danger'>Not Deleted</div><div style='clear:both;'></div>";
}

}



?>
<!--------------------------------------ADD NEW EXAMINER--------------------------------------->



<div style="background-color:#ccffcc;">
                <table class="table span12 table-responsive table-stripped">
                    <tr class="bg-success">
                <th class="btn-lg">Add Question</th>
            <th></th>
            <th></th>
            <th></th>
           
           
            
            
            </tr>
            <tr>
                <td><form action="emp_question.php" method="post">
                     <div class="form-group">
                            <span class="control-lable">Select Subject</span>
                            <select class="form-control" id="newsub1" name="newsub">
<?php                          
$conn = new mysqli($servername, $dbuname, $dbupass, $dbname);
// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "select distinct subject from oes_subject";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    
    echo "<option>--Select Sub--</option>";
    while($row = $result2->fetch_assoc()) {
        //echo "id: " . $row["empid"]." :::: Name-".$row["empname"]. "<br>";
        
        echo "<option>".$row["subject"]."</option>";
    }
} 
else
{
    echo "<script>alert('No Subjects')</script>";
}                                  
?>
                            </select>
                            
                        </div>
                </td>
                <td>
                     <div class="form-group">
                            <span class="control-lable">Question</span>
                            <textarea name="newques" class="form-control" rows="5" placeholder="Enter Your Question" required=""></textarea>
                        </div>
                </td>
                <td>
                     <div class="form-group" style="margin-bottom:2px;">
                         <textarea name="newoption1" class="form-control" rows="1" placeholder="Option 1 Here" required=""></textarea>
                             </div>
                    
                    <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="newoption2" class="form-control" rows="1" placeholder="Option 2 Here" required=""></textarea>
                             </div>
                
                <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="newoption3" class="form-control" rows="1" placeholder="Option 3 Here" required=""></textarea>
                             </div>
                    <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="newoption4" class="form-control" rows="1" placeholder="Option 4 Here" required=""></textarea>
                     </div>
                </td>
                
                
                <td>
                     <div class="form-group">
                            <span class="control-lable">Answer Option</span>
                            <select name="newans" class="form-control">
                                <option>option1</option>
                                <option>option2</option>
                                <option>option3</option>
                                <option>option4</option>
                            </select>
                             </div>
                     <div class="form-group">
                            <span class="control-lable">Action</span>
                            <input type="submit" class="form-control" value="Add Question" id="addbtn" name="addbtn" disabled="" style="height:50px;">
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

$sql = "select * from oes_questionbank";
$result = $conn->query($sql);


?>
    <table id="example" class="table span12 table-hover">
        <thead>
            <tr class="bg-info">
                <th class="btn-lg">Edit/Delete Question</th>
            <th></th>
            <th></th>
            <th></th>
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
               <td><form action="emp_question.php" method="post"><input type="hidden" name="oldcode" value="<?php echo $row["code"]; ?>"><?php echo $row["subject"]; ?></td>
                <td>
                     <textarea name="oldques" class="form-control" rows="5" required="" placeholder="Enter Your Question"><?php echo $row["question"]; ?></textarea>
                </td>
                <td>
                     <div class="form-group" style="margin-bottom:2px;">
                         <textarea name="oldoption1" class="form-control" required="" rows="1" placeholder="Option 1 Here"><?php echo $row["option1"]; ?></textarea>
                             </div>
                    
                    <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="oldoption2" class="form-control" required="" rows="1" placeholder="Option 2 Here"><?php echo $row["option2"]; ?></textarea>
                             </div>
                
                <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="oldoption3" class="form-control" required="" rows="1" placeholder="Option 3 Here"><?php echo $row["option3"]; ?></textarea>
                             </div>
                    <div class="form-group" style="margin-bottom:2px;">
                            <textarea name="oldoption4" class="form-control" required="" rows="1" placeholder="Option 4 Here"><?php echo $row["option4"]; ?></textarea>
                     </div>
                </td>
                
                
                <td>
               
                     <div class="form-group">
                            <span class="control-lable">Answer Option</span>
                            <select name="oldans" class="form-control">
                                <option <?php if($row["answer"]=="option1") echo "selected";?>>option1</option>
                                <option <?php if($row["answer"]=="option2") echo "selected";?>>option2</option>
                                <option <?php if($row["answer"]=="option3") echo "selected";?>>option3</option>
                                <option <?php if($row["answer"]=="option4") echo "selected";?>>option4</option>
                            </select>
                             </div>
                     <div class="form-group">
                            <input type="submit" class="form-control btn-warning" value="Update Question" id="updtbtn" name="updtbtn" style="height:35px;margin-bottom:3px;">
                            <input type="submit" class="form-control btn-danger" value="Delete Question" id="delbtn" name="delbtn" style="height:35px;">
                     </div></form>
                </td>
               
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