<?php
session_start();
require '../connect.php';

$product_id = intval($_POST['product_id']);

// Ensure cart array exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add product to cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]++;
} else {
    $_SESSION['cart'][$product_id] = 1;
}

// Calculate the total items in the cart
$cart_count = array_sum($_SESSION['cart']);
$_SESSION['cart_count'] = $cart_count;

// Return the updated cart count
echo $cart_count;
?>
