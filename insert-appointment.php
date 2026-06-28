<?php
// Aapki screenshot wali config file ko link kiya hai yahan
include('config.php');

if (isset($_POST['submit_appointment'])) {
    // Form se bheja hua data secure karke variables mein save kiya
    $doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);
    $doc_name = mysqli_real_escape_string($conn, $_POST['doc_name']);
    $doc_spec = mysqli_real_escape_string($conn, $_POST['doc_spec']);
    $doc_fee = mysqli_real_escape_string($conn, $_POST['doc_fee']);
    $doc_status = mysqli_real_escape_string($conn, $_POST['doc_status']);

    // SQL Insert Query (Table ka naam vet_consults rakha hai)
    $query = "INSERT INTO `vet_consults` (`doc_id`, `doc_name`, `doc_spec`, `doc_fee`, `doc_status`) 
              VALUES ('$doc_id', '$doc_name', '$doc_spec', '$doc_fee', '$doc_status')";

    // Query run karne ka check
    if (mysqli_query($conn, $query)) {
        // Agar save ho jaye to alert popup aaye aur page redirect ho jaye
        echo "<script>
                alert('Appointment added successfully!');
                window.location.href='vet-consults.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Connection close kiya
mysqli_close($conn);
?>