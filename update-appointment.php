<?php
// Database connection file include ki
include('config.php');

if (isset($_POST['update_doctor'])) {
    // Form se aane wale data ko secure kiya
    $doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);
    $doc_name = mysqli_real_escape_string($conn, $_POST['doc_name']);
    $doc_spec = mysqli_real_escape_string($conn, $_POST['doc_spec']);
    $doc_fee = mysqli_real_escape_string($conn, $_POST['doc_fee']);
    $doc_status = mysqli_real_escape_string($conn, $_POST['doc_status']);

    // Database table 'vet_consults' ke column names ke mutabiq query run ki
    $query = "UPDATE `vet_consults` 
              SET `doc_name` = '$doc_name', 
                  `doc_spec` = '$doc_spec', 
                  `doc_fee` = '$doc_fee', 
                  `doc_status` = '$doc_status' 
              WHERE `doc_id` = '$doc_id'";

    if (mysqli_query($conn, $query)) {
        // Successful update ke baad main page par redirect
        header("Location: vet-consults.php?update=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Agar koi direct access kare toh wapas bhej dein
    header("Location: vet-consults.php");
    exit();
}
?>