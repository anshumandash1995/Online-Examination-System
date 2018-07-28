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
           
        $(document).ready(function(){
          $('#timerdisplay').text("10:00");
          $("#examwindows").hide();
          $("#finalwindow").hide();
           //starttimercountdown();
           /////////////////////FULLSCREEN CALL START///////////////////////////
           document.addEventListener("keydown", function(e) { if (e.keyCode == 32) {toggleFullScreen();}}, false);
            /////////////////////FULLSCREEN CALL END///////////////////////////
            
            
            /////START EXAM CALL/////
            $("#startexambtn").click(function(){
            initloaddata();
    });
    
    $("#submitexambutton").click(function(){
          $("#examwindows").hide();
          $("#finalwindow").show();
          calculateresultofstudent();
          
          
          
    });
            /////////////////////////
            /////////////////////////
            
            
            
            
        });
        
 
 ///////////////////////////////////////////START EXAM CODE GOES HERE////////////////////////////////////////////
 /// LOADS QUESTION RANDOMLY FROM examprocess/load.php
 /// STARTS THE TIMER
 /// RETRIVES FIRST QUESTION TO #examwindows
 /// HIDES THE START SCREEN
 function initloaddata()
 {
     $("#startwindows").hide(500);
            $("#examwindows").show(1000);
            
            
            if($("#hssub").val()==="")
            {
                getdata("Subject Retrive Error",'Start your exam again');
                generateLeft('error',notification_html[4]);
                setTimeout(function(){
                     window.location.assign("studenthome.php");   
                },2000);
                
                
            }
            else
            {
                var d = new Date();
                $("#hstime").val(d.getHours()+":"+d.getMinutes());
                processloaddata();
                 setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="S")
                   {
                       processloaddata_onsucessalert();
                   }
                   else
                   {
                       processloaddata_onerroralert();
                   }
               },1000);
            }
 }
 
 function processloaddata()
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
                  xmlhttp.open("GET","examprocess/loadquestion.php?sid="+$("#hsid").val()+"&sname="+$("#hsname").val()+"&scourse="+$("#hscourse").val()+"&semester="+$("#hssem").val()+"&subject="+$("#hssub").val()+"&rtime="+$("#hstime").val(),true);
                  xmlhttp.send();
 }
 
 function processloaddata_onsucessalert()
        {
            // getdata("Data Processed Successfully",document.getElementById("txtHint").innerHTML.substring(7));
           
            // generate('success',notification_html[4]); 
           
            
         
        $("#randomid").val(document.getElementById("txtHint").innerHTML.substring(7));
       // $("#exampanel").html("Questions");
       // $("#exampanel").html($("#exampanel").html()+"<h3>"+$("#randomid").val()+"</h3>");
        
        var arrayid=$("#randomid").val().split("@");
                    
                          
                //         for (index = 0; index < arrayid.length-1; index++) {
                    
                //         $("#quid-"+(index+1)).val(arrayid[index]);
                //         $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quid-"+(index+1)).val()+"</h2>");
                //     }
       
                
              var index = -1;
(function addDot() {
  setTimeout(function() {
    if (index++ < arrayid.length-2) {
       $("#quid-"+(index+1)).val(arrayid[index]);
       //$("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quid-"+(index+1)).val()+"</h2>");
      
      retrivequesdetails($("#quid-"+(index+1)).val(),(index+1));
      addDot();
    }
  }, 1000);
})();  
}
        
        function processloaddata_onerroralert()
        {
            getdata(document.getElementById("txtHint").innerHTML,'');
            generate('error',notification_html[4]);
            setTimeout(function(){
                     window.location.assign("studenthome.php");   
                },5000);
        }
        
        
        
        
 function retrivequesdetails(quesid,num)
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
            xmlhttp.open("GET","examprocess/getsinglequestion.php?qid="+quesid,true);
            xmlhttp.send();
            
            setTimeout(function(){
                //$("#exampanel").html("");
                 var arrayid1=document.getElementById("txtHint").innerHTML.split("#");
                $("#quid-"+num).val(arrayid1[0]);
                $("#quop1-"+num).val(arrayid1[1]);
                $("#quop2-"+num).val(arrayid1[2]);
                $("#quop3-"+num).val(arrayid1[3]);
                $("#quop4-"+num).val(arrayid1[4]);
                $("#quans-"+num).val(arrayid1[5]);
                $("#status-"+num).val("loaded");
                // $("#exampanel").html($("#exampanel").html()+"<h2>"+num+". "+$("#quid-"+num).val()+"</h2>");
                // $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quop1-"+num).val()+"</h2>");
                // $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quop2-"+num).val()+"</h2>");
               // $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quop3-"+num).val()+"</h2>");
               // $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quop4-"+num).val()+"</h2>");
               // $("#exampanel").html($("#exampanel").html()+"<h2>"+$("#quans-"+num).val()+"</h2>");
                
                 
                 $("#questionholder").text(num+". "+$("#quid-"+num).val());
                 $("#option1holder").text($("#quop1-"+num).val());
                 $("#option2holder").text($("#quop2-"+num).val());
                 $("#option3holder").text($("#quop3-"+num).val());
                 $("#option4holder").text($("#quop4-"+num).val());
                 
                  $("#currentindex").val("1");
                  
               
            },1000);
            if(num===10)
            {
                setTimeout(function(){
                  switchindex();  
                },3000);
            
            }
            
 }       
 
 function switchindex()
 {
     $("#questionholder").text("1. "+$("#quid-"+$("#currentindex").val()).val());
                 $("#option1holder").text($("#quop1-"+$("#currentindex").val()).val());
                 $("#option2holder").text($("#quop2-"+$("#currentindex").val()).val());
                 $("#option3holder").text($("#quop3-"+$("#currentindex").val()).val());
                 $("#option4holder").text($("#quop4-"+$("#currentindex").val()).val());
                starttimercountdown();
                
                validatenextprevious();
            getdata("Questions Loaded : EXAM STARTED","click on this windows to hide");
           
            generate('info',notification_html[4]);
 }
 
 
 $(document).ready(function()
 {
    
    $("#qubtn-1").click(function(){
                 $("#questionholder").text("1. "+$("#quid-1").val());
                 $("#option1holder").text($("#quop1-1").val());
                 $("#option2holder").text($("#quop2-1").val());
                 $("#option3holder").text($("#quop3-1").val());
                 $("#option4holder").text($("#quop4-1").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("1");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-2").click(function(){
                 $("#questionholder").text("2. "+$("#quid-2").val());
                 $("#option1holder").text($("#quop1-2").val());
                 $("#option2holder").text($("#quop2-2").val());
                 $("#option3holder").text($("#quop3-2").val());
                 $("#option4holder").text($("#quop4-2").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("2");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-3").click(function(){
                 $("#questionholder").text("3. "+$("#quid-3").val());
                 $("#option1holder").text($("#quop1-3").val());
                 $("#option2holder").text($("#quop2-3").val());
                 $("#option3holder").text($("#quop3-3").val());
                 $("#option4holder").text($("#quop4-3").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("3");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-4").click(function(){
                 $("#questionholder").text("4. "+$("#quid-4").val());
                 $("#option1holder").text($("#quop1-4").val());
                 $("#option2holder").text($("#quop2-4").val());
                 $("#option3holder").text($("#quop3-4").val());
                 $("#option4holder").text($("#quop4-4").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("4");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-5").click(function(){
                 $("#questionholder").text("5. "+$("#quid-5").val());
                 $("#option1holder").text($("#quop1-5").val());
                 $("#option2holder").text($("#quop2-5").val());
                 $("#option3holder").text($("#quop3-5").val());
                 $("#option4holder").text($("#quop4-5").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("5");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-6").click(function(){
                 $("#questionholder").text("6. "+$("#quid-6").val());
                 $("#option1holder").text($("#quop1-6").val());
                 $("#option2holder").text($("#quop2-6").val());
                 $("#option3holder").text($("#quop3-6").val());
                 $("#option4holder").text($("#quop4-6").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("6");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-7").click(function(){
                 $("#questionholder").text("7. "+$("#quid-7").val());
                 $("#option1holder").text($("#quop1-7").val());
                 $("#option2holder").text($("#quop2-7").val());
                 $("#option3holder").text($("#quop3-7").val());
                 $("#option4holder").text($("#quop4-7").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("7");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-8").click(function(){
                 $("#questionholder").text("8. "+$("#quid-8").val());
                 $("#option1holder").text($("#quop1-8").val());
                 $("#option2holder").text($("#quop2-8").val());
                 $("#option3holder").text($("#quop3-8").val());
                 $("#option4holder").text($("#quop4-8").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("8");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-9").click(function(){
                 $("#questionholder").text("9. "+$("#quid-9").val());
                 $("#option1holder").text($("#quop1-9").val());
                 $("#option2holder").text($("#quop2-9").val());
                 $("#option3holder").text($("#quop3-9").val());
                 $("#option4holder").text($("#quop4-9").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("9");
                  processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    $("#qubtn-10").click(function(){
                 $("#questionholder").text("10. "+$("#quid-10").val());
                 $("#option1holder").text($("#quop1-10").val());
                 $("#option2holder").text($("#quop2-10").val());
                 $("#option3holder").text($("#quop3-10").val());
                 $("#option4holder").text($("#quop4-10").val());
                  processradiobuttondata(parseInt($("#currentindex").val())+1);
                 $("#currentindex").val("10");
                 processoptiondata($("#currentindex").val());
                 validatenextprevious();
    }); 
    
    
     $("#qunextbtn").click(function(){
         processradiobuttondata(parseInt($("#currentindex").val())+1);
        $("#currentindex").val((parseInt($("#currentindex").val())+1).toString());
            processoptiondata($("#currentindex").val());
                 $("#questionholder").text($("#currentindex").val()+". "+$("#quid-"+$("#currentindex").val()).val());
                 $("#option1holder").text($("#quop1-"+$("#currentindex").val()).val());
                 $("#option2holder").text($("#quop2-"+$("#currentindex").val()).val());
                 $("#option3holder").text($("#quop3-"+$("#currentindex").val()).val());
                 $("#option4holder").text($("#quop4-"+$("#currentindex").val()).val());
                 validatenextprevious();
    });
    
    $("#quprebtn").click(function(){
        processradiobuttondata(parseInt($("#currentindex").val())+1);
        
        $("#currentindex").val((parseInt($("#currentindex").val())-1).toString());
            processoptiondata($("#currentindex").val());
                 $("#questionholder").text($("#currentindex").val()+". "+$("#quid-"+$("#currentindex").val()).val());
                 $("#option1holder").text($("#quop1-"+$("#currentindex").val()).val());
                 $("#option2holder").text($("#quop2-"+$("#currentindex").val()).val());
                 $("#option3holder").text($("#quop3-"+$("#currentindex").val()).val());
                 $("#option4holder").text($("#quop4-"+$("#currentindex").val()).val());
                 validatenextprevious();
    });
    
    
    
 });
 
 
 function processradiobuttondata(data)
 {
     data=(parseInt(data)-1).toString();
     var x="";
     if(document.getElementById("chkoption1").checked===true)
     {
         x="option1";
         $("#qubtn-"+data).removeClass("btn-warning");
         $("#qubtn-"+data).addClass("btn-primary");
         $("#status-"+data).val(x);
     }
     else if((document.getElementById("chkoption2").checked===true))
     {
         x="option2";
         $("#qubtn-"+data).removeClass("btn-warning");
         $("#qubtn-"+data).addClass("btn-primary");
         $("#status-"+data).val(x);
     }
     else if((document.getElementById("chkoption3").checked===true))
     {
         x="option3";
         $("#qubtn-"+data).removeClass("btn-warning");
         $("#qubtn-"+data).addClass("btn-primary");
         $("#status-"+data).val(x);
     }
     else if((document.getElementById("chkoption4").checked===true))
     {
         x="option4";
         $("#qubtn-"+data).removeClass("btn-warning");
         $("#qubtn-"+data).addClass("btn-primary");
        $("#status-"+data).val(x);
     }
     else
     {
         x="loaded";
         $("#status-"+data).val(x);
     }
     
     //alert(data+"-Current :"+$("#status-"+data).val());
     
     setTimeout(function(){
         document.getElementById("chkoption1").checked=false;
     document.getElementById("chkoption2").checked=false;
     document.getElementById("chkoption3").checked=false;
      document.getElementById("chkoption4").checked=false;
     },20);
     
     
     
 }
 
 
 
 
 function processoptiondata(data)
 {
    
   // alert(data+"-Now :"+$("#status-"+data).val());
        switch($("#status-"+data).val())
     {
         case "option1":
             setTimeout(function(){
         document.getElementById("chkoption1").checked=true;
     },30);
             break;
             case "option2":
             setTimeout(function(){
         document.getElementById("chkoption2").checked=true;
     },30);
             break;
             case "option3":
             setTimeout(function(){
         document.getElementById("chkoption3").checked=true;
     },30);
             break;
             case "option4":
             setTimeout(function(){
         document.getElementById("chkoption4").checked=true;
     },30);
             break;
         default:
           //  alert("Not Selected any option");
             break;
     }
    
 }
 
 
 
 
 
 
 
 
 function validatenextprevious()
 {
    
     
     
     if($("#currentindex").val()==="1")
     {
         $("#quprebtn").removeClass("btn-primary");
         $("#quprebtn").attr("disabled","");
     }
     else
     {
          $("#quprebtn").addClass("btn-primary");
         $("#quprebtn").removeAttr("disabled");
     }
     if($("#currentindex").val()==="10")
     {
          $("#qunextbtn").removeClass("btn-primary");
         $("#qunextbtn").attr("disabled","");
     }
     else
     {
          $("#qunextbtn").addClass("btn-primary");
         $("#qunextbtn").removeAttr("disabled");
     }
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////START EXAM CODE///////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////




 /////////////////////////////////////////////FULLSCREEN CALL START/////////////////////////////////////////////       
      function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
} 
///////////////////////////////////////////////FULLSCREEN CALL END////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////TIMER COUNT DOWN START///////////////////////////////////////////////////////
  
        function starttimercountdown()
        {  var fiveMinutes = 60 * 10,
        display = $('#timerdisplay');
    startTimer(fiveMinutes, display);

        }
       
function startTimer(duration, display) {
    var swtch=0;
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        
        if(swtch==0 && minutes==3 && seconds==0)
{
    
    getdata("You Have 3 Minutes Left","click on this windows to hide");
    generate('error',notification_html[4]);
    swtch=1;
    display.css("display","none");
}
if(swtch==1 && minutes==0 && seconds==0)
{
     $("#examwindows").hide();
          $("#finalwindow").show();
          calculateresultofstudent();
    //alert("4 minutes left");
    swtch=2;
display.css("display","none");
}


        display.text(minutes + ":" + seconds);
    
        if (--timer < 0) {
            timer = duration;
         }
    }, 1000);
}
            
 ///////////////////////////////////////TIMER COUNT DOWN END///////////////////////////////////////           
 //////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////
 
 
 /////////////////////////////////////CALCULATE SUBMIT EXAM RESULT///////////////////////////////////
 function calculateresultofstudent()
 {
     $('#timerdisplay').css("display","none");
     processradiobuttondata(parseInt($("#currentindex").val())+1);
     datar=0;
     for(indexn=1;indexn<=10;indexn++)
     {
         if($("#status-"+indexn).val()===$("#quans-"+indexn).val())
        datar=datar+10;
        }
    $("#progressbarresult").html("Result : <kbd>"+datar+"%</kbd> out of 100 Total");
    
    $("#rprogressbar").val(datar);
    
    
    setTimeout(function(){
              //getdata("Data Submission Started","click on this windows to hide");
             // generate('success',notification_html[4]);
              processloaddata1(datar);
          },1000);
                 setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="S")
                   {
                       processloaddata_onsucessalert1();
                   }
                   else
                   {
                       processloaddata_onerroralert1();
                   }
               },2000);
    
    
        for(indexn=1;indexn<=10;indexn++)
     {
         colori="red";
         if($("#status-"+indexn).val()===$("#quans-"+indexn).val())
         {
             colori="green";
         }
      
     $("#finalwindow1").html($("#finalwindow1").html()+"<h3 style=padding:5px;margin:top:30px;background-color:"+colori+";>Ques["+indexn+"]. "+$("#quid-"+indexn).val()+"</h3>");
     $("#finalwindow1").html($("#finalwindow1").html()+"<h5>Option-1. "+$("#quop1-"+indexn).val()+"</h5>");
     $("#finalwindow1").html($("#finalwindow1").html()+"<h5>Option-2. "+$("#quop2-"+indexn).val()+"</h5>");
     $("#finalwindow1").html($("#finalwindow1").html()+"<h5>Option-3. "+$("#quop3-"+indexn).val()+"</h5>");
      $("#finalwindow1").html($("#finalwindow1").html()+"<h5>Option-4. "+$("#quop4-"+indexn).val()+"</h5>"); 
        $("#finalwindow1").html($("#finalwindow1").html()+"<h4>Your Answer : "+$("#status-"+indexn).val()+"<code style='box-shadow:1px 5px 5px -5px black;'>Correct Option :"+$("#quans-"+indexn).val()+"</code></h4>"); 
   
        }
 }
 ///////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////FINAL RESULT UPLOAD////////////////////////////////////////////////

 
 function processloaddata1(totalmark)
 {
    // "examprocess/resultcalculate.php?sid="+$("#hsid").val()+"&subject="+$("#hssub").val()+"&mark="+totalmark
     
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
                  xmlhttp.open("GET","examprocess/resultcalculate.php?sid="+$("#hsid").val()+"&subject="+$("#hssub").val()+"&mark="+totalmark.toString(),true);
                  xmlhttp.send();
           
                  
 }
 
 
 function validate_finalDataSubmit()
 {
     setTimeout(function(){
                   if(document.getElementById("txtHint").innerHTML.substring(0,1)==="S")
                   {
                       processloaddata_onsucessalert1();
                   }
                   else
                   {
                       processloaddata_onerroralert1();
                   }
               },1000);
 }
 function processloaddata_onsucessalert1()
        {
             getdata("Data Processed Successfully",document.getElementById("txtHint").innerHTML.substring(7));
             generate('success',notification_html[4]); 
}
        
        function processloaddata_onerroralert1()
        {
            getdata(document.getElementById("txtHint").innerHTML,'');
            generate('error',notification_html[4]);
        }             
        
        
            </script>
            
            <script language="javascript" type="text/javascript">

document.oncontextmenu=RightMouseDown;
document.onmousedown = mouseDown; 



function mouseDown(e) {
    if (e.which==3) {//righClick
        alert("Right Mouse Click is disabled");
    }
}


function RightMouseDown() { return false; }

</script>
          
    </head>
    
    <body >
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


$stdsub=filter_input(INPUT_POST,"subjectname");
?>
   
        
    <h1 class="text-right effect2" style="margin:0;padding:20px;margin-bottom:5px;background-color: #00cccc">EXAM WINDOW</h1>
    <h1 class="text-center" id="timerdisplay" style="margin:0;padding:20px;margin-bottom:5px;background-color: #33ffff;width:200px;position:absolute;top:0px;">TIMER</h1>  
    <div class="container-fluid text-right" style="margin-top:15px;">NAME : <kbd><?php echo $stdname; ?></kbd><br />SID : <code><?php echo $stdid; ?></code><br />Subject Code : <code><?php echo filter_input(INPUT_POST,"subjectname"); ?></code></div>
        
            <div id="txtHint" class="btn btn-success btn-block" style="display:none;"><b>Process Status...</b></div>
            
            
            
            
            
            
 <!-----------------------------------------START WINDOWS---------------------------------->         
 <input type="hidden"  value="<?php echo $stdid; ?>" id="hsid">
 <input type="hidden" value="<?php echo $stdname; ?>" id="hsname">
 <input type="hidden" value="<?php echo $stdcourse; ?>" id="hscourse">
 <input type="hidden" value="<?php echo $stdsem; ?>" id="hssem">
 <input type="hidden" value="<?php echo $stdsub; ?>" id="hssub">
 <input type="hidden" value="" id="hstime">
  <input type="hidden" value="" id="randomid">
  <input type="hidden" value="" id="currentid">
  <input type="hidden" value="" id="currentindex">
  
  
  
            <div class="container" id="startwindows">
                <div style="margin-top:30px;min-height:200px;background-color:#ebebeb" >
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1">
                            
                            <table class=" table-responsive">
                                <tr><td><h2>Instruction:</h2></td><td></td></tr>
                                <tr> <td>Total number of questions </td> <td>: 10.</td></tr>

<tr><td>Time alloted for exam</td> <td>: 10 minutes.</td></tr>

<tr><td>Each question carry </td> <td>: 10 Marks</td></tr>
<tr><td>Negetive Mark</td><td>: No</td></tr>
<tr><td>Click for Fullscreen</td><td><button class="btn btn-warning" onclick="toggleFullScreen();" style="margin-top: 5px;">Toggle Fullscreen</button></td></tr>
                            </table>
                        </div>
                        <div class="col-sm-5">
                            <table class=" table-responsive">
                                <tr> <td><h2>Note</h2></td> <td></td></tr>
                                <tr> <td></td> <td><li>During exam click the 'Submit Test' button given in the bottom of this page to Submit your answers.</li></td></tr>
<tr> <td></td> <td><li>Test will be submitted automatically if the time expired.</li></td></tr>
<tr> <td></td> <td><li>Don't refresh the page.</li></td></tr>
                            
                            </table>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-sm-2 col-sm-offset-5"><button class="btn btn-primary btn-block" id="startexambtn" style="">START EXAM</button></div>
            </div>
               
            
        </div>
 <!---------------------------------------------------------------------------------------------------------------->
 <!---------------------------------------------------------------------------------------------------------------->
 
 
 
 <!-----------------------------------------------EXAM WINDOW STARTS HERE------------------------------------------->
  <div class="container" id="examwindows">
      <div style="margin-top:30px;min-height:300px;background-color: #ebebeb">
          
          <div class="row">
              <div class="col-sm-2" style="box-shadow:0px 10px 10px -10px #999999;margin:10px 25px;background-color: #66ccff;padding:0px;border-radius:10px;">
                  <h2 style="border-top-left-radius:10px;border-top-right-radius:10px;padding:10px 0px;margin-top:0px;box-shadow:0px 2px 2px #999999;background-color: #0099cc;color:whitesmoke;text-align:center;">NAVIGATOR</h2>
                  <div style="padding:10px;">
                      <style>
                          #navigator-table td
                          {
                              padding:3px;
                          }
                          #navigator-table td button
                          {
                              color:black;
                          }
                      </style>
                      <table class="table-responsive" width="100%" id="navigator-table">
                          <tr>
                              <td><button class="btn btn-warning btn-block" id="qubtn-1">1</button>
                                  <input type="hidden" id="quid-1">
                                  <input type="hidden" id="quop1-1">
                                  <input type="hidden" id="quop2-1">
                                  <input type="hidden" id="quop3-1">
                                  <input type="hidden" id="quop4-1">
                                  <input type="hidden" id="quans-1">
                                  <input type="hidden" id="status-1">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-2">2</button>
                              <input type="hidden" id="quid-2">
                                  <input type="hidden" id="quop1-2">
                                  <input type="hidden" id="quop2-2">
                                  <input type="hidden" id="quop3-2">
                                  <input type="hidden" id="quop4-2">
                                  <input type="hidden" id="quans-2">
                                  <input type="hidden" id="status-2">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-3">3</button>
                              <input type="hidden" id="quid-3">
                                  <input type="hidden" id="quop1-3">
                                  <input type="hidden" id="quop2-3">
                                  <input type="hidden" id="quop3-3">
                                  <input type="hidden" id="quop4-3">
                                  <input type="hidden" id="quans-3">
                                  <input type="hidden" id="status-3"></td>
                          </tr>
                          <tr>
                              <td><button class="btn btn-warning btn-block" id="qubtn-4">4</button>
                              <input type="hidden" id="quid-4">
                                  <input type="hidden" id="quop1-4">
                                  <input type="hidden" id="quop2-4">
                                  <input type="hidden" id="quop3-4">
                                  <input type="hidden" id="quop4-4">
                                  <input type="hidden" id="quans-4">
                                  <input type="hidden" id="status-4">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-5">5</button>
                                  <input type="hidden" id="quid-5">
                                  <input type="hidden" id="quop1-5">
                                  <input type="hidden" id="quop2-5">
                                  <input type="hidden" id="quop3-5">
                                  <input type="hidden" id="quop4-5">
                                  <input type="hidden" id="quans-5">
                                  <input type="hidden" id="status-5">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-6">6</button>
                              <input type="hidden" id="quid-6">
                                  <input type="hidden" id="quop1-6">
                                  <input type="hidden" id="quop2-6">
                                  <input type="hidden" id="quop3-6">
                                  <input type="hidden" id="quop4-6">
                                  <input type="hidden" id="quans-6">
                                  <input type="hidden" id="status-6">
                              </td>
                          </tr>
                          <tr>
                              <td><button class="btn btn-warning btn-block" id="qubtn-7">7</button>
                              <input type="hidden" id="quid-7">
                                  <input type="hidden" id="quop1-7">
                                  <input type="hidden" id="quop2-7">
                                  <input type="hidden" id="quop3-7">
                                  <input type="hidden" id="quop4-7">
                                  <input type="hidden" id="quans-7">
                                  <input type="hidden" id="status-7">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-8">8</button>
                              <input type="hidden" id="quid-8">
                                  <input type="hidden" id="quop1-8">
                                  <input type="hidden" id="quop2-8">
                                  <input type="hidden" id="quop3-8">
                                  <input type="hidden" id="quop4-8">
                                  <input type="hidden" id="quans-8">
                                  <input type="hidden" id="status-8">
                              </td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-9">9</button>
                              <input type="hidden" id="quid-9">
                                  <input type="hidden" id="quop1-9">
                                  <input type="hidden" id="quop2-9">
                                  <input type="hidden" id="quop3-9">
                                  <input type="hidden" id="quop4-9">
                                  <input type="hidden" id="quans-9">
                                  <input type="hidden" id="status-9">
                              </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td><button class="btn btn-warning btn-block" id="qubtn-10">10</button>
                              <input type="hidden" id="quid-10">
                                  <input type="hidden" id="quop1-10">
                                  <input type="hidden" id="quop2-10">
                                  <input type="hidden" id="quop3-10">
                                  <input type="hidden" id="quop4-10">
                                  <input type="hidden" id="quans-10">
                                  <input type="hidden" id="status-10">
                              </td>
                              <td></td>
                              
                          </tr>
                      </table>
                  
                  </div>
              </div>
              <div class="col-sm-9"  id="exampanel">
                  <h4 id="questionholder" style="margin-top:30px;"></h4>
                  <table class="table-responsive">
                      <tr><td><input type="radio" id="chkoption1" value="option1" name="optiongroup"></td><td><h5 id="option1holder"></h5></td></tr>
                      <tr><td><input type="radio" id="chkoption2" value="option2" name="optiongroup"></td><td><h5 id="option2holder"></h6></td></tr>
                      <tr><td><input type="radio" id="chkoption3" value="option3" name="optiongroup"></td><td><h5 id="option3holder"></h5></td></tr>
                      <tr><td><input type="radio" id="chkoption4" value="option4" name="optiongroup"></td><td><h5 id="option4holder"></h5></td></tr>
                  </table>
                  <div class="col-sm-3"><input type="button" value="PREVIOUS  <<" id="quprebtn" class="btn btn-primary btn-block"></div>
                  <div class="col-sm-3 col-sm-offset-2"><input class="btn btn-primary btn-block" id="qunextbtn" type="button" value=">>  NEXT"></div>
              </div>
              
          </div>
          <div style="clear:both;"></div>
          <div class="col-sm-2 col-sm-offset-5"><button class="btn btn-danger btn-block" id="submitexambutton" style="margin-top: 20px;" >SUBMIT TEST</button></div>
      </div>
      
  </div>
 <!----------------------------------------------------------------------------------------------------------------->
 <!----------------------------------------------------------------------------------------------------------------->
 
 <!----------------------------------------------FINAL WINDOW-------------------------------------------------------->
            <div class="container" id="finalwindow">
                <div style="height:30px;margin-bottom:10px;width:100%;">
                    <h2 class="btn btn-success" id="progressbarresult"></h2>
                    <progress style="width:100%;height:100%;" id="rprogressbar" value="0" max="100"></progress>
                    
                </div>
                <div style="margin-top:60px;height:300px;background-color:#ebebeb;overflow: auto;" id="finalwindow1">
                    
            </div>
            <div class="col-sm-2 col-sm-offset-5"><button class="btn btn-primary btn-block" id="endexambutton" style="margin-top: 5px;" onclick="window.location.assign('studenthome.php');">CLOSE EXAM</button></div>
        </div>
 <!------------------------------------------------------------------------------------------------------------------>
 <!------------------------------------------------------------------------------------------------------------------>
       </body>
</html>