<?php
session_start();
require("connection.php");
$output='';
        if (isset($_SESSION["touser"])) {
            $r = $con->query("SELECT * FROM messages WHERE fromU= '".$_SESSION["user"]."' AND toU='".$_SESSION["touser"]."' OR fromU= '".$_SESSION["touser"]."' AND toU='".$_SESSION["user"]."' ");
        if ($r){
            while($w = $r->fetch_array(MYSQLI_ASSOC)) {
                if ($w["fromU"]==$_SESSION["user"]){
                    $output='<div  class="messagefrom-him">
                    <p>'.$w['message'].'</p>
                </div>';
                }
                else{
                    $output='<div class="messagefrom-me" >
                    <p>'.$w['message'].'</p>

                </div>';
                }
                echo $output;
            };
        }
        }
        ?>
