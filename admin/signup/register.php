<?php
session_start();
include '../connect.php';

if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['emailInput'];
    $password = $_POST['passwordInput'];
    $profilePicture = 'default.jpg'; // Default profile picture

    // Check if a profile picture is uploaded
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = "../../uploads/";
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $profilePicture = "uploads/" . basename($_FILES["profile_picture"]["name"]);
        } else {
            echo "Error uploading profile picture.";
        }
    }

    $result = $db->query("SELECT * FROM user WHERE email = '$email' OR username = '$username'");
    if ($result->num_rows > 0) {
        echo "Email Address or Username Already Exists!";
    } else {
        if ($db->query("INSERT INTO user (username, vorname, nachname, email, password, profile_picture) VALUES ('$username', '$firstName', '$lastName', '$email', '$password', '$profilePicture')")) {
            header("Location: ../login/login.php");
            exit;
        } else {
            echo "Error: <a href='signup.php'>Try again</a>" . $db->error;
        }
    }
    $db->close();
}
?>
