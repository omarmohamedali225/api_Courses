<?php
header('Access-Control-Allow-Origin: *');
header("content-type: application/json; chartset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
$local = "fdb1032.awardspace.net";
$name = "4365800_api";
$password = "Api@1234";
$dbname = "4365800_api";
$con = mysqli_connect($local,$name,$password,$dbname) or die("ERROR CONECTION");
if(!$con){
  die("ERROR CONECTION");
}
?>