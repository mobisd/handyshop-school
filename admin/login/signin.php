<?php
session_start();
require("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email='$login' OR username='$login'";
    $result = $db->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['vorname'];
            $_SESSION['lastname'] = $row['nachname'];
            $_SESSION['profile_picture'] = $row['profile_picture']; // Ensure this field is set


            if (!isset($_SESSION['cart_count'])) {
                $_SESSION['cart_count'] = 0;
            }

            header("Location: ../../index.php");
            exit;
        } else {
            echo "Incorrect password. <a href='login.php'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='../signup/signup.php'>Register</a>";
    }
}

$db->close();
?>
