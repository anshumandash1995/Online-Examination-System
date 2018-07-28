<html>
<head>
    
    
    <link rel="stylesheet" href="db/sciriptcss/bootstrap.min.css">
    <link rel="stylesheet" href="db/sciriptcss/jquery.dataTables.css">
    <script src="db/sciriptcss/jquery-1.8.2.min.js"></script>
    <script src="db/sciriptcss/jquery.dataTables.min.js"></script>
    
<script>
    var data=0;
function showUser() {
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","datasource.php",true);
        xmlhttp.send();
    data+=1;
    document.getElementById("datasp").innerHTML=data;
    
    
}
$(document).ready(function pp(){
    showUser();
    $('#txtHint').dataTable(); 
});
</script>
</head>
<body>
    <input type="text" name="ename">

    <input type="button" onclick="showUser()" value="Hello Click Here">

<br>
<div id="txtHint1"><b>Person info will be listed here...</b></div>

<table id="txtHint" class="table table-striped table-responsive"></table>

<div id="datasp"></div>

</body>
</html>