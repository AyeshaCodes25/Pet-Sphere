<?php
session_start();
$conn=mysqli_connect("localhost","root","","mydummy");
$a=mysqli_select_db($conn,"mydummy");
/*if($a==true){
    echo "database is connected";
}*/




?>