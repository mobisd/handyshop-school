<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HandyShop</title>
    <link href="../../assets/logo/Transparent_Logo.png" rel="icon">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Welcome Back!</h2>
                        <form action="signin.php" method="post">
                            <div class="mb-3">
                                <label for="loginInput" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="loginInput" name="login" placeholder="Enter email or username" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password" required>
                                <span id="togglePassword" class="password-toggle-icon"><i class="fas fa-eye"></i></span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="signIn">Login</button>
                        </form>
                        <p class="text-center mt-3">
                            Don't have an Account? <a href="../signup/signup.php" class="text-primary">Sign up now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('passwordInput');
            const passwordIcon = e.target;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            passwordIcon.classList.toggle('fa-eye');
            passwordIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
