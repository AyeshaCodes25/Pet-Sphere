<?php
include("connection.php");
if($_POST["submit"]==true){
    $pet-Breed=$_POST["fn"];
     $lname=$_POST["ln"];
     $mail=$_POST["mail"];
     $pass=$_POST["pswd"];
     $q="INSERT INTO mystudent(first_name,last_name,email,password)
     VALUES('$fname','$lname','$mail','$pass')";
     $result=mysqli_query($conn,$q);
     if($result==true){
        header("location:display_user.php");
     }
}







?>