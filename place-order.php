<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pet_sphere");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Form se data lein
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    
    // Mobile number handle karein (agar user ne dala hai)
    $mobile_number = isset($_POST['mobile_number']) ? mysqli_real_escape_string($conn, $_POST['mobile_number']) : '';
    
    // Session se details
    $product_name = isset($_SESSION['cart_item']['name']) ? $_SESSION['cart_item']['name'] : 'Russian Cat';
    $product_price = isset($_SESSION['cart_item']['price']) ? $_SESSION['cart_item']['price'] : 25000.00;

    // 2. Query chalaein
    $sql = "INSERT INTO orders (customer_name, email, phone, address, payment_method, product_name, price, mobile_number) 
            VALUES ('$name', '$email', '$phone', '$address', '$payment_method', '$product_name', '$product_price', '$mobile_number')";

    if (mysqli_query($conn, $sql)) {
        // 3. Redirect to Success
        header("Location: success.php");
        exit();
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>