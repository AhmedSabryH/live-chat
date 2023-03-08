<?php
session_start();
 require("connection.php");
 if ($_SESSION["user"]==null) {
    header("location:index.php");
 }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><?php
    if (isset($_GET["touser"])) {
        echo $_GET["touser"];
    } else{echo"ChatBox";}?></title>
    <link rel="icon" href="chat.png">
    <style>
    </style>
</head>
 <body onload="real()">
 <div class="out"><?php echo'<h1 style="color: white;"> Hello: &nbsp; '.$_SESSION["user"].'</h1> <a href="?out=""" style:><img src="out.png" width="100%" haight="100%" /></a>'?>
 </div>
 <div class="messagecenter">
        <div class="rightside">
        <ul style="margin: 19px 0 0 23px; font-siz:large;">
            <p class="friend">Friends</p>
            <?php
            $r = $con->query("SELECT * FROM users WHERE UserName != '".$_SESSION["user"]."'");
            if ($r) {
                while ($w = $r->fetch_array(MYSQLI_ASSOC)) {
                    echo'<li style="width:90%"><a href="?touser='.$w["UserName"].'">'.$w["UserName"].'</a></li>
                    ';
                    
                }
            }?>
            </ul>
        </div>

        <div class="leftside">
            <div class="chat">
                <div class="header" id="header">
                <div class="leftheader"> <?php if (isset($_SESSION["touser"])){ 
                    $r = $con->query("SELECT * FROM users WHERE UserName = '".$_SESSION["touser"]."'");
                    $w = $r->fetch_array(MYSQLI_ASSOC);
                    if ($w["type"]=="active") {
                    echo'<h1 style="color:rgb(85, 184, 85); ">online</h1>';
                }
                else{
                echo'<h1 style="color:red;">offline</h1>';

            }
            } ?>
        </div>
        <div class="rightheader"><div class="infouser"><?php if (isset($_SESSION["touser"])) {
                echo$_SESSION["touser"];
                } ?>
                
            </div>
                
            </div>
                </div>
                <div class="mainchat">
                        <div class="messagecontin" id="conmsg">
                            
                        </div>
                    <div class="foterchat">
                        <input type="text" placeholder="  type..." id="msg" onclick="re()"
                            style="width: 80%; height: 90%; padding: 10px; color: white; font-size: 15px; border-radius: 10px; outline: unset; border: unset; background: rgba(128, 95, 93, 0.678);">
                        <input type="button" id="btn" class="hove" value="SEND>" onclick="send()">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    if (isset($_GET["touser"])) {
        $_SESSION["touser"]=$_GET["touser"];
    }
    
    if (isset($_GET['out'])) {
            session_destroy();
            $r = $con->query("UPDATE users SET type='deactive' WHERE UserName='".$_SESSION["user"]."'");
            header("Location:index.php");
    }
    ?>
 </body>
 </html>
 <script>
    var messageBody = document.querySelector('#conmsg');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
     function re() {   
        $('#header').load(document.URL +' #header');
        // window.location.reload();
    //     setTimeout(function sb() => {
    // },1000);
    }
    
     var input = document.getElementById("msg");
     // Execute a function when the user presses a key on the keyboard
     input.addEventListener("keypress", function(event) {
       // If the user presses the "Enter" key on the keyboard
       if (event.key === "Enter") {
         // Cancel the default action, if needed
         event.preventDefault();
         // Trigger the button element with a click
         document.getElementById("btn").click();
       }
     });
     
    function send(){
        
        n=document.getElementById('msg').value;
        x=new XMLHttpRequest();
        x.onreadystatechange=function(){
            if(x.readyState==4&&x.status==200){
                // document.getElementById('result').innerHTML=x.responseText;
                // alert(x.responseText);
            }
        }
        x.open("GET","insertMessage.php?msg="+n+"");
        x.send();
        document.getElementById('msg').value="";
    }
    setInterval(real, 200);


function real(){
            x=new XMLHttpRequest();
        x.onreadystatechange=function(){
            if(x.readyState==4&&x.status==200){
            document.getElementById('conmsg').innerHTML=x.responseText;
                // alert(x.responseText);
            }
        }
        x.open("GET","realTimeChat.php?touser=''");
        x.send();    
        }
 </script>