<?php 
session_start();
$con = mysqli_connect('localhost', 'root', '', 'crud');

if(!$con) {
    die(mysqli_error($con));
}
else{
   
}
?>