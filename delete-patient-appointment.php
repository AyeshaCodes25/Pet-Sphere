<?php
include('config.php');

if (isset($_GET['id'])) {
    $app_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Live appointments table se row delete karne ki query
    $delete_query = "DELETE FROM `appointments` WHERE `id` = '$app_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>