<?php
// Aapki config file ko link kiya hai
include('config.php');

if (isset($_POST['submit_medicine'])) {
    // Form se secure tarike se values get kein
    $m_id = mysqli_real_escape_string($conn, $_POST['m_id']);
    $m_name = mysqli_real_escape_string($conn, $_POST['m_name']);
    $m_cat = mysqli_real_escape_string($conn, $_POST['m_cat']);
    $m_price = mysqli_real_escape_string($conn, $_POST['m_price']);
    $m_status = mysqli_real_escape_string($conn, $_POST['m_status']);

    // SQL Insert Query
    $query = "INSERT INTO `pharmacy_inventory` (`m_id`, `m_name`, `m_cat`, `m_price`, `m_status`) 
              VALUES ('$m_id', '$m_name', '$m_cat', '$m_price', '$m_status')";

    if (mysqli_query($conn, $query)) {
        // Success alert popup aur automatic dashboard par return
        echo "<script>
                alert('New medicine stock added successfully!');
                window.location.href='dashboard-pharmacy.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Connection close kiya
mysqli_close($conn);
?>