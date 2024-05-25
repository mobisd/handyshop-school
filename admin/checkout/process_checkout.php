<?php
session_start();
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['id'];
    $cartItems = $_SESSION['cart'];
    
    $totalAmount = 0;
    foreach ($cartItems as $productId => $quantity) {
        $result = $db->query("SELECT preis FROM produkte WHERE id = $productId");
        if ($result) {
            $product = $result->fetch_assoc();
            $totalAmount += $product['preis'] * $quantity;
        }
    }

    $db->query("INSERT INTO orders (user_id, total_amount) VALUES ('$userId', '$totalAmount')");
    $orderId = $db->insert_id;

    foreach ($cartItems as $productId => $quantity) {
        $result = $db->query("SELECT preis FROM produkte WHERE id = $productId");
        if ($result) {
            $product = $result->fetch_assoc();
            $price = $product['preis'];

            $db->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$price')");
        }
    }

    unset($_SESSION['cart']);
    $_SESSION['cart_count'] = 0;

    header('Location: success.php');
    exit();
}
?>
