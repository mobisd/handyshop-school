<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - HandyShop</title>
    <link href="../../assets/logo/Transparent_Logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Create Account</h2>
                        <form method="post" action="register.php" enctype="multipart/form-data" id="signUp">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="emailinput" class="form-label">E-Mail Address</label>
                                <input type="email" class="form-control" name="emailInput" id="emailInput" placeholder="Email Address" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="passwordInput" id="passwordInput" placeholder="Password" required>
                                <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture (optional)</label>
                                <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="termsCheck">
                                <label class="form-check-label" for="termsCheck">Agree to terms</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="signUp">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">
                            Already registered? <a href="../login/login.php">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
