<html>
<head>
     <link rel="stylesheet" href="sciriptcss/bootstrap.min.css">
    <link rel="stylesheet" href="sciriptcss/jquery.dataTables.css">
    <script src="sciriptcss/jquery-1.8.2.min.js"></script>
    <script src="sciriptcss/jquery.dataTables.min.js"></script>
<script>

function showUser() {
   
      alert("Welcome To OES");
//        if (window.XMLHttpRequest) {
//            // code for IE7+, Firefox, Chrome, Opera, Safari
//            xmlhttp = new XMLHttpRequest();
//        } else {
//            // code for IE6, IE5
//            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//        }
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
//            }
//        }
//        xmlhttp.open("GET","datasource.php",true);
//        xmlhttp.send();
  
}
</script>
</head>
<body class="bg-success">
        <div class="jumbotron text-center btn-lg">LOGIN PAGE</div>
        
        <div class="col-sm-4 col-sm-offset-4">
           
            <div class="form-horizontal">
                
            <div class="form-group">
            <label class="control-label col-sm-3" for="uid">User ID : </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter ID">
            </div>
            </div>
                
            <div class="form-group">
            <label class="control-label col-sm-3" for="pwd">Password : </label>
            <div class="col-sm-9">
            <input type="password" class="form-control" id="pwd" name="upass" placeholder="Enter password">
            </div>
            </div>
            </div>
        
            <div class="form-group">        
            <div class="col-sm-offset-3 col-sm-9">
            <button type="button" class="btn btn-default" onclick="showUser()">Sign IN</button>
            </div>
            </div>
            
        </div>
    
    
    <br />
    
    <div class="col-sm-12">
<div id="txtHint" ><b>Person info will be listed here...</b></div>
</div>
</body>
</html>