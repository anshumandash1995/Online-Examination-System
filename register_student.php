<html lang="en">
  <head>
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.2/material.teal-red.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
    #view-source 
    {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
  <?php
        
if(isset($_COOKIE['user_id']))
{
    if($_COOKIE['user_id']!="")
    {
      echo $_COOKIE['user_id'];
    }
    else
    {
        echo "<script>window.location.assign('index.php');</script>";
    }
}
else
{
    echo "<script>window.location.assign('index.php');</script>";
}
        ?>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
    
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            
            <h3>Student's Registration <br><br></h3>
            <h4 style="color: red;">* This link will be in valid within <strong>5 mins</strong> of opening this window.<br>* Please be quick !</h4>
             <form action="register_student.php" method="post">
             <h3>User ID<br></h3>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input name="uid" class="mdl-textfield__input" type="text" id="sample1" maxlength="50" value="<?php echo $_COOKIE['user_id'];?>">
    <label class="mdl-textfield__label" for="sample1">Your ID :</label>
  </div>
<h3>Full Name <br></h3>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input name="uname" class="mdl-textfield__input" type="text" id="sample1" maxlength="50">
    <label class="mdl-textfield__label" for="sample1">Your Name :</label>
  </div>
  <h3>Password <br></h3>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input name="upass" class="mdl-textfield__input" type="password" id="sample1" maxlength="50">
    <label class="mdl-textfield__label" for="sample1">Your Password :</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input name="upass2" class="mdl-textfield__input" type="password" id="sample1" maxlength="50">
    <label class="mdl-textfield__label" for="sample1">Re-enter Password :</label>
  </div>
  <h3>Categories available : <br></h3>
  <?php
							include 'admin/database.php';

							$get_cat = mysql_query("SELECT * FROM oes_subject");

							while ($rows = mysql_fetch_array($get_cat)) {
								$tit = $rows["course"];
								$cat = $rows["code"];
								$sem = $rows["semester"];
								$sub = $rows["subject"];
								echo "<h5>$cat || $tit || $sem || $sub <br></h5>";
							}
							?>
							<h3>Your Branch : <br></h3>
  <select class="budget" name="post_branch">
							<option><h4>Select Branch</h4></option>
							<?php
							include 'admin/database.php';

							$get_category = mysql_query("SELECT * FROM oes_subject");

							while ($rows = mysql_fetch_array($get_category)) {
								$title = $rows["course"];
								$category = $rows["code"];
								echo "<option value='$title'><h5>$category. $title</h5></option>";
							}

							?>
						</select>
							<h3>Your Semester: <br></h3>
  <select class="budget" name="post_sems">
							<option><h4>Select Semester</h4></option>
							<?php
							include 'admin/database.php';

							$get_category = mysql_query("SELECT * FROM oes_subject");

							while ($rows = mysql_fetch_array($get_category)) {
								$sems = $rows["semester"];
								$category = $rows["code"];
								echo "<option value='$sems'><h5>$category. $sems</h5></option>";
							}

							?>
						</select>
						<br><br><br><br>
						<button type="submit" name="submit" value="Publish Now" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
  Register
</button>
  </div>
  </div>
  </div>

  

  
  
           
</form>
          </div>
        </div>
      </main>
    </div>
    <script src="https://code.getmdl.io/1.1.2/material.min.js"></script>
  </body>
</html>
<?php 
	include 'admin/database.php';
if (isset($_POST['submit'])) {
	$uid = $_POST['uid'];
	$uname = $_POST['uname'];
	$upass = $_POST['upass'];
	$upass2 = $_POST['upass2'];
	$branch = $_POST['post_branch'];
	$sems = $_POST['post_sems'];
	$status = "active";
	if ($upass==$upass2) {
		if ($uname=="" OR $upass=="" OR $branch=="" OR $sems=="") {
	echo "<script>alert('* Please fill in all the fields')</script>";
	die();
}
else{
	$insert_posts = "insert into oes_student (studentid,studentname,password,course,semester,status) values ('$uid','$uname','$upass','$branch','$sems','$status')";
	$add_blog = mysql_query($insert_posts);

	echo "<script>alert('You are now registered !')</script>";
	echo "<script>window.open('index.php','_self')</script>";

}
	}
	else {

		echo "<script>alert('* Passwords mismatch');</script>";
	}
	
	
}
	?>
