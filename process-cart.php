<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['cart_item'] = [
        'name'  => $_POST['product_name'],
        'price' => (float)$_POST['product_price'],
        'image' => $_POST['product_image']
    ];
    echo "Success";
}
?>