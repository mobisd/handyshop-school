<?php
session_start();
require '../connect.php';

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    echo "<div class='container mt-5'>
            <h2 class='text-center'>Checkout</h2>
            <div class='alert alert-info text-center'>Your cart is empty.</div>
            <div class='text-center'>
                <a href='../../index.php' class='btn btn-secondary'>Continue Shopping</a>
            </div>
          </div>";
    exit;
}

// Fetch cart items from the database
$cart_items = $_SESSION['cart'];
$placeholders = implode(',', array_fill(0, count($cart_items), '?'));
$stmt = $db->prepare("SELECT * FROM produkte WHERE id IN ($placeholders)");
$stmt->bind_param(str_repeat('i', count($cart_items)), ...array_keys($cart_items));
$stmt->execute();
$result = $stmt->get_result();

$total = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Checkout</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                        $product_id = $row['id'];
                        $quantity = $cart_items[$product_id];
                        $subtotal = $row['preis'] * $quantity;
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><img src="../../assets/produkte/<?php echo $row['bild']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['preis']; ?> €</td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $subtotal; ?> €</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total:</th>
                        <th><?php echo $total; ?> €</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center">
            <a href="../../index.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
        <div class="mt-4">
            <h4>Shipping Details</h4>
            <form action="process_checkout.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Complete Purchase</button>
            </form>
        </div>
    </div>
</body>
</html>
