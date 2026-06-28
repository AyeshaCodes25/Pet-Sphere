<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Input arrays ko fetch kiya
    $ids = $_POST['pet_id'];
    $breeds = $_POST['pet_breed'];
    $categories = $_POST['pet_category'];
    $prices = $_POST['pet_price'];

    // Loop chala kar database tables ke column names ke mutabiq update kiya
    foreach ($ids as $index => $id) {
        $breed = mysqli_real_escape_string($conn, $breeds[$index]);
        $category = mysqli_real_escape_string($conn, $categories[$index]);
        $price = mysqli_real_escape_string($conn, $prices[$index]);

        $update_query = "UPDATE `manage_pet_shop` SET 
                         `Pet_Breed` = '$breed', 
                         `Category` = '$category', 
                         `Price` = '$price' 
                         WHERE `ID` = '$id'";
        
        mysqli_query($conn, $update_query);
    }

    // Update hone ke baad wapis manage shop page par redirect kiya
    header("Location: manage-pets.php");
    exit();
}
?>