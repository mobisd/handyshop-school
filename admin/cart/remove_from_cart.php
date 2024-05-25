<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    // Update cart count
    $_SESSION['cart_count'] = array_sum($_SESSION['cart']);
}

header('Location: cart.php');
exit;
?>
