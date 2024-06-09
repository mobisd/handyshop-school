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
        <div class="card shadow-sm">
            <img class="card-img-top" src="assets/produkte/{$row['bild']}" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title">{$row['name']}</h5>
                <p class="card-text">{$row['beschreibung']}</p>
                <p class="card-text"><strong>Category:</strong> {$row['kategorie']}</p>
                <p class="card-text"><strong>Price:</strong> {$row['preis']}</p>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success add-to-cart" data-product-id="{$row['id']}">
                        Add to Cart
                    </button>
                </div>
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
