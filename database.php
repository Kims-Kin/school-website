<?php
$server="localhost";
$username="root";
$password="";
$database="knjogu";
$conn= new mysqli($server,$username,$password,$database);
if($conn->connect_error){
    die("connection failed".conn->connect_error);
}else{
    echo"Hey there Kim you have successfully connected";
}
?>
