<?php
session_start();
 require("connection.php");
 if(isset($_GET["msg"])==true&&$_GET["msg"]!=''&&isset($_SESSION["user"])==true&&isset($_SESSION["touser"])==true){
    $r = $con->query("INSERT INTO messages VALUES ('null','".$_SESSION["user"]."','".$_SESSION["touser"]."','".$_GET["msg"]."')");

}
 ?>