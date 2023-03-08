<?php
session_start();
 require("connection.php");
    if(isset($_GET["n"])==true&&$_GET["n"]!=''){
        $r = $con->query("INSERT INTO users VALUES ('null','".$_GET["n"]."','deactive')");
        header('Location:index.php');
    }
    if(isset($_GET["user"])==true&&$_GET["user"]!=''){
        $_SESSION["user"]=$_GET["user"];
        $r = $con->query("UPDATE users SET type='active' WHERE UserName='".$_SESSION["user"]."'");
        header('Location:chatBox.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="chat.png">
    <title>Login</title>
</head>
<body>
<div class="con">
        <div class="main">
            <div class="userss">
                <?php
                    if(isset($_GET["creat"])==true){
                        echo'<a href="index.php" style="color:blue;"><..Back</a>
                        <form action="index.php" method="get" style="margin: auto; justify-content: center; align-items: center; width: 100%; display: flex; height: 88%;">
                        <input type="text" placeholder="Enter You Name..." name="n" required style="width: 60%; height: 10%; border-radius: 30px; border: 1px solid darkblue; text-align: center; font-size: 20px;">
                        ';
                    }
                    else{
                        echo'<ol>';
                        $r = $con->query("SELECT * FROM users ");
                        if ($r) {
                            while ($w = $r->fetch_array(MYSQLI_ASSOC)) {
                                echo'
                                <li><a href="?user='.$w["UserName"].'">'.$w["UserName"].'</a></li><br>';
                            }
                        }
                    echo'</ol>';
                    }
                ?>
            </div>
            <div class="btn">
                <?php
                if(isset($_GET["creat"])==true){
                    echo'<a href="" style="cursor:default; width: 100%; height: 100%; display: flex; justify-content:center; align-items: center;">
                    <input type="submit" value="OK" style="cursor: pointer;">
                    </a>
                        </form>';
                }
                else{
                    echo'<a href="?creat=" style="cursor:default; width: 100%; height: 100%; display: flex; justify-content: end; align-items: center;">
                    <input type="submit" value="Creat New" style="cursor: pointer;">
                    </a>';
                }
                ?>    
        </div>
        </div>
    </div>

</body>
</html>