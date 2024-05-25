<?php
session_start();
require 'admin/connect.php';

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: admin/login/login.php');
    exit;
}

$userId = $_SESSION['id'];
$message = "";

// Fetch user data
$query = "SELECT username, vorname, nachname, email, password, profile_picture FROM user WHERE id='$userId'";
$result = $db->query($query);
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profilePicture = $user['profile_picture'];

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $profilePicture = $targetFile;
        } else {
            $message = "Error uploading profile picture.";
        }
    }

    $updateQuery = "UPDATE user SET username='$username', vorname='$firstName', nachname='$lastName', email='$email', password='$password', profile_picture='$profilePicture' WHERE id='$userId'";
    if ($db->query($updateQuery)) {
        $message = "Profile updated successfully.";
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstName;
        $_SESSION['lastname'] = $lastName;
        $_SESSION['profile_picture'] = $profilePicture;
    } else {
        $message = "Error updating profile: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="icon" type="image/x-icon" href="/assets/logo/Transparent_Logo.png">
<head>
    <title>Profile Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 0.5rem 0 0.2rem;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        button {
            padding: 0.7rem;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            margin-bottom: 1rem;
        }
        button:hover {
            background: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }
        .message {
            text-align: center;
            margin-bottom: 1rem;
            color: #d9534f;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 1rem;
        }
        .profile-picture img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .back-link {
            display: inline-block;
            text-align: center;
            padding: 0.7rem;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }
        .back-link:hover {
            background: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile Page</h1>
        <p class="message"><?php echo $message; ?></p>
        <form method="post" enctype="multipart/form-data">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['vorname']); ?>" required>
            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['nachname']); ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
            <label>Profile Picture:</label>
            <input type="file" name="profile_picture">
            <?php if ($user['profile_picture']): ?>
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
                </div>
            <?php endif; ?>
            <button type="submit">Update Profile</button>
            <a href="/index.php" class="back-link">Go Back</a>
        </form>
    </div>
</body>
</html>

<?php $db->close(); ?>
