<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login/login.php');
    exit;
}

require '../admin/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productDescription = $_POST['product_description'];
        $productImage = 'default.jpg';

        if (!empty($_FILES['product_image']['name'])) {
            $targetDir = "../assets/produkte/";
            $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
                $productImage = basename($_FILES["product_image"]["name"]);
            }
        }

        $query = "INSERT INTO produkte (name, preis, beschreibung, bild) VALUES ('$productName', '$productPrice', '$productDescription', '$productImage')";
        $db->query($query);
    }

    if (isset($_POST['delete'])) {
        $productId = $_POST['product_id'];
        $query = "DELETE FROM produkte WHERE id='$productId'";
        $db->query($query);
    }

    if (isset($_POST['update'])) {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productDescription = $_POST['product_description'];
        $productImage = $_POST['current_image'];

        if (!empty($_FILES['product_image']['name'])) {
            $targetDir = "../assets/produkte/";
            $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
                $productImage = basename($_FILES["product_image"]["name"]);
            }
        }

        $query = "UPDATE produkte SET name='$productName', preis='$productPrice', beschreibung='$productDescription', bild='$productImage' WHERE id='$productId'";
        $db->query($query);
    }
}

$products = $db->query("SELECT * FROM produkte")->fetch_all(MYSQLI_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addUser'])) {
        $username = $_POST['username'];
        $firstName = $_POST['vorname'];
        $lastName = $_POST['nachname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profilePicture = 'uploads/default.jpg'; // Default profile picture path
    
        // Check if a profile picture is uploaded
        if (!empty($_FILES['profile_picture']['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                $profilePicture = 'uploads/' . basename($_FILES["profile_picture"]["name"]);
            } else {
                echo "Error uploading profile picture.";
            }
        }
    
        $query = "INSERT INTO user (username, vorname, nachname, email, password, profile_picture) VALUES ('$username', '$firstName', '$lastName', '$email', '$password', '$profilePicture')";
        $db->query($query);
    }

    if (isset($_POST['deleteUser'])) {
        $userId = $_POST['user_id'];
        $query = "DELETE FROM user WHERE id='$userId'";
        $db->query($query);
    }

    if (isset($_POST['updateUser'])) {
        $userId = $_POST['user_id'];
        $username = $_POST['username'];
        $firstName = $_POST['vorname'];
        $lastName = $_POST['nachname'];
        $email = $_POST['email'];
        $profilePicture = $_POST['current_image']; // Use the current image by default
    
        // Check if a new profile picture is uploaded
        if (!empty($_FILES['profile_picture']['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                $profilePicture = 'uploads/' . basename($_FILES["profile_picture"]["name"]);
            } else {
                echo "Error uploading profile picture.";
            }
        }
    
        // Admin password verification
        $adminPassword = $_POST['admin_password'];
        $adminQuery = "SELECT password FROM user WHERE username='admin'";
        $adminResult = $db->query($adminQuery);
        $adminRow = $adminResult->fetch_assoc();
    
        if ($adminRow && $adminRow['password'] === $adminPassword) {
            $query = "UPDATE user SET username='$username', vorname='$firstName', nachname='$lastName', email='$email', profile_picture='$profilePicture' WHERE id='$userId'";
            $db->query($query);
        } else {
            echo "Invalid admin password!";
        }
    }
}
$users = $db->query("SELECT * FROM user")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo/Transparent_Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img src="/assets/logo/Transparent_Logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            <a class="navbar-brand" href="#">HandyHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['id'])): ?>
                    <div class="nav-item profile-container">
                        <img src="../uploads/default.jpg" alt="Profile" class="profile-picture" onclick="toggleDropdown()">
                        <span class="navbar-text ms-2"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></span>
                        <div class="profile-dropdown" id="profileDropdown">
                            <a href="../profile.php">Edit Profile</a>
                            <a href="../logout.php">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav> -->

    <div class="d-flex">
        <nav id="sidebar" class="bg-dark">
            <p class="fs-2">Admin Dashboard</p>
            <ul class="list-unstyled">
                <li><a href="#" id="nav-products" class="nav-link text-white"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="#" id="nav-users" class="nav-link text-white"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="../index.php" class="nav-link text-white"><i class="fas fa-home"></i> Back to Index</a></li>
                <div class="typeshi">
                <a href="../logout.php" class="btn btn-danger">Logout</a>
                <?php if(isset($_SESSION['id'])): ?>
                    <div class="nav-item profile-container">
                        <img src="../uploads/default.jpg" alt="Profile" class="profile-picture">
                        <span class="navbar-text ms-2"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></span>
                    </div>
                <?php endif; ?>
                </div>
                </ul>
        </nav>

        <div class="container mt-5 d-flex justify-content-center" id="content">
            <div class="content-inner">
                <section id="products-section">
                    <h1 class="text-center">Products</h1>
                    <form method="post" enctype="multipart/form-data" class="mb-5">
                        <p class="fs-2 fw-bolder">Add Product</p>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="product_image" name="product_image">
                        </div>
                        <button type="submit" class="btn btn-primary2" name="add">Add Product</button>
                    </form>

                    <p class="fs-2 fw-bolder">Manage Products</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><img src="../assets/produkte/<?php echo htmlspecialchars($product['bild']); ?>" class="product-image" alt="Product Image"></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['preis']); ?></td>
                                <td><?php echo htmlspecialchars($product['beschreibung']); ?></td>
                                <td>
                                    <form method="post" style="display:inline-block;">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="current_image" value="<?php echo $product['bild']; ?>">
                                        <button type="button" id="editbtn" class="btn btn-primary" onclick="populateEditForm(<?php echo htmlspecialchars(json_encode($product)); ?>); scrollToEditForm();">Edit</button>
                                        <button type="submit" class="btn btn-danger2" name="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <form method="post" enctype="multipart/form-data" id="editForm" style="display:none;">
                        <p class="fs-2 fw-bolder">Edit Product</p>
                        <input type="hidden" id="edit_product_id" name="product_id">
                        <input type="hidden" id="current_image" name="current_image">
                        <div class="mb-3">
                            <label for="edit_product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="edit_product_price" name="product_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="edit_product_description" name="product_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="edit_product_image" name="product_image">
                        </div>
                        <button type="submit" class="btn btn-success" name="update">Update Product</button>
                    </form>
                </section>


                <!-- Users Section -->
                <section id="users-section" style="display: none;">
                <h1 class="text-center">Users</h1>
                    <form method="post" enctype="multipart/form-data" class="mb-5">
                        <h2>Add User</h2>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="vorname" class="form-label">Vorname</label>
                            <input type="text" class="form-control" id="vorname" name="vorname" required>
                        </div>
                        <div class="mb-3">
                            <label for="nachname" class="form-label">Nachname</label>
                            <input type="text" class="form-control" id="nachname" name="nachname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                        <button type="submit" class="btn btn-primary2" name="addUser">Add User</button>
                    </form>

                    <h2>Manage Users</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Profile Picture</th>
                                <th>Username</th>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><img src="../<?php echo htmlspecialchars($user['profile_picture']); ?>" class="profile-picture" alt="Profile Picture"></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['vorname']); ?></td>
                                <td><?php echo htmlspecialchars($user['nachname']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <form method="post" style="display:inline-block;">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <input type="hidden" name="current_image" value="<?php echo $user['profile_picture']; ?>">
                                        <button type="button" class="btn btn-primary" onclick="populateEditUserForm(<?php echo htmlspecialchars(json_encode($user));?>); scrollToUserEditForm();">Edit</button>
                                        <button type="submit" class="btn btn-danger" name="deleteUser">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <form method="post" id="editUserForm" enctype="multipart/form-data" style="display:none;">
    <h2>Edit User</h2>
    <input type="hidden" id="edit_user_id" name="user_id">
    <input type="hidden" id="current_image" name="current_image">
    <div class="mb-3">
        <label for="edit_username" class="form-label">Username</label>
        <input type="text" class="form-control" id="edit_username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="edit_vorname" class="form-label">Vorname</label>
        <input type="text" class="form-control" id="edit_vorname" name="vorname" required>
    </div>
    <div class="mb-3">
        <label for="edit_nachname" class="form-label">Nachname</label>
        <input type="text" class="form-control" id="edit_nachname" name="nachname" required>
    </div>
    <div class="mb-3">
        <label for="edit_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="edit_email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="edit_profile_picture" class="form-label">Profile Picture</label>
        <input type="file" class="form-control" id="edit_profile_picture" name="profile_picture">
    </div>
    <div class="mb-3">
        <label for="admin_password" class="form-label">Admin Password</label>
        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
    </div>
    <button type="submit" class="btn btn-success" name="updateUser">Update User</button>
</form>

                </section>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container py-2">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">About</a></li>
            </ul>
            <div class="text-center mb-3">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <p class="text-center text-body-primary">© 2024 Company, SCHMID MORITZ WÆH</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function populateEditForm(product) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('edit_product_id').value = product.id;
            document.getElementById('edit_product_name').value = product.name;
            document.getElementById('edit_product_price').value = product.preis;
            document.getElementById('edit_product_description').value = product.beschreibung;
            document.getElementById('current_image').value = product.bild;
        }

        function populateEditUserForm(user) {
    document.getElementById('editUserForm').style.display = 'block';
    document.getElementById('edit_user_id').value = user.id;
    document.getElementById('edit_username').value = user.username;
    document.getElementById('edit_vorname').value = user.vorname;
    document.getElementById('edit_nachname').value = user.nachname;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('current_image').value = user.profile_picture;
    document.getElementById('edit_profile_picture').value = ''; // Clear the file input
}

        function scrollToEditForm() {
            document.getElementById('editForm').scrollIntoView({behavior: "smooth"});
        }

        function scrollToUserEditForm() {
            document.getElementById('editUserForm').scrollIntoView({behavior: "smooth"});
        }

        function toggleDropdown() {
            var dropdown = document.getElementById("profileDropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }

        document.getElementById('nav-products').addEventListener('click', function() {
            document.getElementById('products-section').style.display = 'block';
            document.getElementById('users-section').style.display = 'none';
        });

        document.getElementById('nav-users').addEventListener('click', function() {
            document.getElementById('products-section').style.display = 'none';
            document.getElementById('users-section').style.display = 'block';
        });

    </script>
</body>
</html>
