<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OES-Login Page</title>
        
        <?php
// Start the session
session_start();
$_SESSION["userid"]="";
?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate1.css">
        <link rel="stylesheet" href="css/buttons.css">
        
        
        
        <script type="text/javascript"  src="script/jquery-hp.js"></script>
        <script type="text/javascript" src="script/bootstrap.js"></script>
        <script type="text/javascript" src="script/jquery.noty.packaged1.js"></script>
        <script type="text/javascript" src="script/notification_html3.js"></script>
       
        
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
        
       
        

        $(document).ready(function () {

            $("#successbtn").click(function c2(){
            
               validateadminlogin();
            
            });
            
            
            
            $("#studentloginbtn").click(function(){
            
               validatestudentlogin();
            
            });
        });
 ////////////////////////////////////////////////STUDENT LOGIN SECTION CODES////////////////////////////////////////////////            
 function validatestudentlogin()
        {
            if($("#sid").val()==="" || $("#sid").val()===null || $("#spass").val()==="" || $("#spass").val()===null)
        {
            //alert('Please enter your userid and password');
            getdata("Please enter your userid and password",'fill before submit');
                generateLeft('error',notification_html[4]);
        }  
        else
        {
            validateStudent();
               setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="W")
                   {
                       onsucessalertSTUDENT();
                   }
                   else
                   {
                       onerroralertSTUDENT();
                   }
               },1000);
        }
        }
 function validateStudent() {
    
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
        xmlhttp.open("GET","student/studentprocess/login-do.php?studentid="+$("#sid").val()+"&studentpass="+$("#spass").val(),true);
        xmlhttp.send();
        }
        function onsucessalertSTUDENT()
        {
            getdata("Welcome User",'Validating Authentication');
                generate('success',notification_html[4]);
                /////////////////////////TIME OUT////////////////////
                        setTimeout(function() {
                        
                        getdata("Hello Student",'Redirecting to your home page in 2 Seconds');
                        generate('information',notification_html[4]);
                        setTimeout(function(){window.location.assign("student/studenthome.php");},2000);
                }, 1000);
               //////////////////////////TIMEOUT END/////////////////////            
        }
        
        function onerroralertSTUDENT()
        {
            getdata(document.getElementById("txtHint").innerHTML,'');
                generate('error',notification_html[4]);
                $("#spass").val("");
                /////////////////////////TIME OUT////////////////////
                        setTimeout(function() {
                        //getdata('Hello Administrator','Redirecting to your home page in 5 Seconds');
                        //generate('information',notification_html[4]);
                
                        setTimeout(function(){
                        //getdata('Ready to Redirect','Redirecting to your home page Now');
                        //generate('Success',notification_html[4]);  
                        },5000);
                
                }, 1000);
               //////////////////////////TIMEOUT END/////////////////////            
        }
        
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////ADMIN LOGIN SECTION CODES////////////////////////////////////////////////       
        function validateadminlogin()
        {
            if($("#aid").val()==="" || $("#aid").val()===null || $("#apass").val()==="" || $("#apass").val()===null)
        {
            //alert('Please enter your userid and password');
            getdata("Please enter your userid and password",'fill before submit');
                generateLeft('error',notification_html[4]);
        }  
        else
        {
            validateAdmin();
               setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="W")
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
        
        
        function validateAdmin() {
    
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
        xmlhttp.open("GET","admin/adminprocess/login-do.php?adminid="+$("#aid").val()+"&adminpass="+$("#apass").val(),true);
        xmlhttp.send();
        }
        
        function onsucessalert()
        {
            getdata("Welcome User",'Validating Authentication');
                generate('success',notification_html[4]);
                /////////////////////////TIME OUT////////////////////
                        setTimeout(function() {
                        
                        if((document.getElementById("txtHint").innerHTML.substr(64,3)).toString()==="adm")
                        {
                        getdata("Hello Administrator",'Redirecting to your home page in 2 Seconds');
                        generate('information',notification_html[4]);
                        setTimeout(function(){window.location.assign("admin/adminhome.php");},2000);
                        }
                        else
                        {
                        getdata("Hello Examiner",'Redirecting to your home page in 2 Seconds');
                        generate('information',notification_html[4]);
                        setTimeout(function(){window.location.assign("admin/employeehome.php");},2000);
                        }
                
                }, 1000);
               //////////////////////////TIMEOUT END/////////////////////            
        }
        
        function onerroralert()
        {
            getdata(document.getElementById("txtHint").innerHTML,'');
                generate('error',notification_html[4]);
                $("#apass").val("");
                /////////////////////////TIME OUT////////////////////
                        setTimeout(function() {
                        //getdata('Hello Administrator','Redirecting to your home page in 5 Seconds');
                        //generate('information',notification_html[4]);
                
                        setTimeout(function(){
                        //getdata('Ready to Redirect','Redirecting to your home page Now');
                        //generate('Success',notification_html[4]);  
                        },5000);
                
                }, 1000);
               //////////////////////////TIMEOUT END/////////////////////            
        }
        
        </script>
        
        
        
        
        
        
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
        
        
    </head>
    <body class="bg-info" >
        
        <!---------------------------------ADMIN LOGIN SECTION--------------------------------->
        <div class="container-fluid bg-success wow bounceIn animated" style="padding-top: 13px;margin-bottom:3px; box-shadow:1px 1px 3px black">
            <div class="col-sm-4"><h2 style="margin:0; color:#666666;">ADMIN / EXAMINER</h2></div>
            <div class="col-sm-5 col-sm-offset-3">
           
            <div class="form-horizontal">
                
            <div class="form-group">
            <div class="col-sm-4" style="padding:0px 5px 0px 0px;">
            <input type="text" class="form-control" id="aid" name="aid" placeholder="Enter ID" style="box-shadow:0px 10px 10px -10px #999999;">
            </div>
            
            <div class="col-sm-4" style="padding:0px 5px 0px 0px;">
            <input type="password" class="form-control" id="apass" name="apass" placeholder="Enter password" style="box-shadow:0px 10px 10px -10px #999999;">
            </div>
            
            
                <div class="col-sm-3" style="padding:0px 0px;">
            <button type="button" class="form-control btn-success btn-block" id="successbtn" style="box-shadow:0px 10px 10px -10px #999999;">Admin Sign IN</button>
            </div> 
            </div>
            
             </div>
                
            
            
        </div>
            </div>
        <!--------------------------HEADER---------------------------------->
       <h1 class="jumbotron text-center  effect2" style="margin:0;padding:20px;margin-bottom:5px;">ONLINE EXAMINATION SYSTEM<small><br/></small></h1>
        
       
       <div class="container">
           <div class="row">
               
               
               <div class="col-sm-8">
                   <div id="txtHint" class="btn btn-success btn-block" style="display:none;"><b>Process Status...</b></div>

               Online Exam System is developed such that students can give online examination of their subjects. Faculty Members announce the schedule of the examination and students can give exam on that particular date. Students can also see the result after giving examination.Modules
There are three modules available in Online Examination System:

<fieldset style="border:1px solid black;"><h4 class="text-center">Modules</h4>
<dl class="dl-horizontal" style="margin:10px 0px;">
  <dt>Administrator</dt>
  <dd>Administrator can manage Exam Categories,Subjects, Faculties and Students.</dd>
  <dt>Faculty</dt>
  <dd>Faculty can manage his/her own profile. Faculty can manage student details,Exam Schedule and Questions to be asked in Examination.</dd>
  <dt>Student</dt>
  <dd>Student can Manage His/Her own profile. Student can give online examination and view the result. Student can also compare answer with actual answer.</dd>

</dl>
</fieldset>
	

	

<fieldset style="border:1px solid black;"><h4 class="text-center">Functionality</h4> 
    <dl class="dl-horizontal" style="margin:10px 0px;">
     <dt>Administrator</dt>
  <dd>(1) Manage Users</dd>
  <dd>(2) Create Manage Exam Schedule</dd>
  <dd>(3) Manage Subject.</dd>
  <dd>(4) Create and Manage Faculty.</dd>
  <dd>(5) Create and Manage Students.</dd>
  <dt>Faculty</dt>
  <dd>(1) Manage Own Profile.</dd>
  <dd>(2) Create Exam Schedule.</dd>
  <dd>(3) Create Question Bank. </dd>
  <dt>Student</dt>
  <dd>(1) Manage Own Profile.</dd>
  <dd>(2) Give Examination.</dd>
  <dd>(3) View Result. </dd>
    </dl>
</div>
               
               
               
              
               <div class="col-sm-3 col-sm-offset-1 wow bounceIn" style="margin-top: 20px;padding:0;border-radius:5px;box-shadow:0px 20px 20px -10px #999999;background-color: #cccccc">
                   <h3 style="border-top-left-radius:10px;border-top-right-radius:10px;padding:10px 0px;margin-top:0px;box-shadow:0px 3px 3px #999999;color:#ffffff;background-color: #999999" class="text-center">STUDENT LOGIN</h3> 
                   <div class="form-group" style="padding: 0px 10px;">
                       <span class="control-lable">Student ID</span>
                       <input type="text" class="form-control" id="sid" style="box-shadow:0px 10px 20px -10px #999999;">
                   </div>
                   <div class="form-group" style="padding: 0px 10px;">
                       <span class="control-lable">Student Pass</span>
                       <input type="password" class="form-control" id="spass" style="box-shadow:0px 10px 20px -10px #999999;">
                   </div>
                   <div class="form-group" style="padding: 0px 10px;">
                       <input type="button" value="Login" class="form-control btn btn-success" id="studentloginbtn" style="box-shadow:0px 10px 20px -10px #999999;">
                   </div>
                  <!-- <h3 style="text-align: center;">OR</h3>
                  <div class="form-group" style="padding: 0px 10px;">
                       <input type="button" value="Register" class="form-control btn btn-success" id="studentloginbtn" data-toggle="modal" data-target="#myModal" style="box-shadow:0px 10px 20px -10px #999999;">
                   -->
				   <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register Now</h4>
      </div>
      <div class="modal-body">
      <form action="index.php" method="post">
                     <fieldset class="form-group">
    <label for="exampleInputEmail1">Student ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter ID" maxlength="50" name="std_id1">
    <small class="text-muted">Enter the ID given to you by your faculty.</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="exampleInputEmail1">Generated Code</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter code" maxlength="12" name="std_code1">
    <small class="text-muted">Enter the ID given to you by your faculty.</small>
  </fieldset>

  <button type="submit" name="studreg1" class="btn btn-primary" name="std_submit">Submit</button>

                   </form>
        
      </div>
      
    </div>
    </div>
  </div>
</div>
<?php 
        include 'admin/database.php';
        if (isset($_POST['studreg1'])) {
           $std_id1 = $_POST['std_id1'];
          $std_code1 = $_POST['std_code1'];
          $search_db = mysql_query("SELECT * FROM studentreg WHERE stdreg_user LIKE '%$std_id1%' ");
            while ($row_posts = mysql_fetch_array($search_db)) {
              $id = $row_posts['stdreg_user'];
              $code = $row_posts['std_code'];
              if ($std_code1==$code && $std_id1==$id) {
                 setcookie('user_id', $id, time()+5000);
  echo "<script>window.open('register_student.php','_self')</script>";
              }
              else{
                echo "<h5 style='color: red;'>* Your User ID and Code does not match. Please contact your faculty.</h5>";
                die();
              }

        
      }
    }

        ?>
               </div>
           </div>
       </div>

    </body>
</html>

