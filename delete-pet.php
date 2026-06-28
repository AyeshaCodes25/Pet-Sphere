<?php
include('config.php');

if (isset($_GET['id'])) {
    $pet_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Database table 'manage_pet_shop' se matching ID delete ki
    $delete_query = "DELETE FROM `manage_pet_shop` WHERE `ID` = '$pet_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>