<?php
session_start();
require '../connect.php';

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (empty($cart_items)) {
    echo "<div class='container mt-5'>
            <h2 class='text-center'>Shopping Cart</h2>
            <div class='alert alert-info text-center'>Your cart is empty.</div>
            <div class='text-center'>
                <a href='../../index.php' class='btn btn-secondary'>Continue Shopping</a>
                <a href='#' class='btn btn-success disabled'>Checkout</a>
            </div>
          </div>";
} else {
    $placeholders = implode(',', array_fill(0, count($cart_items), '?'));
    $stmt = $db->prepare("SELECT * FROM produkte WHERE id IN ($placeholders)");

    // Bind parameters for the query
    $types = str_repeat('i', count($cart_items));
    $stmt->bind_param($types, ...array_keys($cart_items));
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container mt-5'>
            <h2 class='text-center'>Shopping Cart</h2>
            <div class='table-responsive'>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id'];
        $quantity = $cart_items[$product_id];
        $subtotal = $row['preis'] * $quantity;
        $total += $subtotal;

        echo "<tr>
                <td><img src='../../assets/produkte/{$row['bild']}' alt='{$row['name']}' width='50'></td>
                <td>{$row['name']}</td>
                <td>{$row['preis']} €</td>
                <td>{$quantity}</td>
                <td>{$subtotal} €</td>
                <td><a href='remove_from_cart.php?id={$product_id}' class='btn btn-danger'>Remove</a></td>
              </tr>";
    }

    echo "    </tbody>
                <tfoot>
                    <tr>
                        <th colspan='4' class='text-right'>Total:</th>
                        <th>{$total} €</th>
                        <th></th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <div class='text-center'>
                <a href='../../index.php' class='btn btn-secondary'>Continue Shopping</a>
                <a href='../checkout/checkout.php' class='btn btn-success'>Checkout</a>
            </div>
          </div>";
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Shopping Cart</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="cart.css">
    <!-- <style>
        .container {
            margin-top: 50px;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
        .table tbody td img {
            width: 50px;
            height: auto;
        }
        .table tfoot th {
            background-color: #f8f9fa;
        }
        .btn-secondary {
            margin-right: 10px;
        }
        .btn-success {
            margin-left: 10px;
        }
    </style> -->
</head>
<body>
    <div class='container'>
        <!-- Content generated by PHP -->
    </div>
</body>
</html>

