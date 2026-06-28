<?php
include('config.php');

if (isset($_POST['submit_pet'])) {
    // Form se data secure tareeqe se get karein
    $pet_breed = mysqli_real_escape_string($conn, $_POST['pet_breed']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Query mein aapke screenshot wale table aur column ke exact names use kiye hain
    $query = "INSERT INTO `manage_pet_shop` (`Pet_Breed`, `Category`, `Price`, `Status`) VALUES ('$pet_breed', '$category', '$price', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('New pet added successfully!');
                window.location.href='manage-pets.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>