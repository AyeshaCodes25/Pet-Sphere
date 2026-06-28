<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Input arrays ko fetch kiya
    $ids = $_POST['m_id'];
    $names = $_POST['m_name'];
    $categories = $_POST['m_cat'];
    $prices = $_POST['m_price'];

    // Loop chala kar har row ko bari bari update kiya
    foreach ($ids as $index => $id) {
        $name = mysqli_real_escape_string($conn, $names[$index]);
        $category = mysqli_real_escape_string($conn, $categories[$index]);
        $price = mysqli_real_escape_string($conn, $prices[$index]);

        $update_query = "UPDATE `pharmacy_inventory` SET 
                         `m_name` = '$name', 
                         `m_cat` = '$category', 
                         `m_price` = '$price' 
                         WHERE `m_id` = '$id'";
        
        mysqli_query($conn, $update_query);
    }

    // Update hone ke baad wapis pharmacy page par redirect kiya
    header("Location: dashboard-pharmacy.php");
    exit();
}
?>