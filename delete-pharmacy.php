<?php
include('config.php');

if (isset($_GET['id'])) {
    $m_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Database table 'pharmacy_inventory' se matching ID delete ki
    $delete_query = "DELETE FROM `pharmacy_inventory` WHERE `m_id` = '$m_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>