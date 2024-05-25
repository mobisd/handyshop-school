<?php
include("admin/connect.php");
$brand = $_POST['brand'] ?? 'all';

if ($brand == 'all') {
    $query = "SELECT * FROM produkte";
} else {
    $query = "SELECT * FROM produkte WHERE marke = '".mysqli_real_escape_string($db, $brand)."'";
}

$result = mysqli_query($db, $query);
echo '<div class="card-container2">';
while ($row = mysqli_fetch_assoc($result)) {
    echo <<<CARD
        <div class="card2 shadow-sm">
            <img class="card-img-top2" src="assets/produkte/{$row['bild']}" alt="Product Image">
            <div class="card-body2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#details{$row['id']}">
                    Details
                </button>
                <button type="button" class="btn btn-primary add-to-cart" data-product-id="{$row['id']}">
                    In den Warenkorb
                </button>
            </div>
        </div>
    CARD;
}
echo '</div>';
?>

<script>
function attachAddToCartEvent() {
    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;

            fetch('admin/cart/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'product_id=' + productId
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('cartCount').textContent = data;
            })
            .catch(error => console.error('Error:', error));
        });
    });
}

document.addEventListener('DOMContentLoaded', attachAddToCartEvent);
</script>
