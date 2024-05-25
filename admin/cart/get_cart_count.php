<?php
session_start();
echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>
