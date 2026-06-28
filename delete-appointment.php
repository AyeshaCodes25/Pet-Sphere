<?php
include('config.php');

// Check kiya ke URL mein id aayi hai ya nahi
if (isset($_GET['id'])) {
    $doc_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Database table 'vet_consults' se query run ki
    $delete_query = "DELETE FROM `vet_consults` WHERE `doc_id` = '$doc_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        // JavaScript ko success response bheja
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>