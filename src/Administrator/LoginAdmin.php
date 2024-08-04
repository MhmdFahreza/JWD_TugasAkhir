<?php
session_start();

// Hardcoded valid credentials
$valid_nickname = "Admin";
$valid_password = "12345";

// Initialize error message
$error_message = '';
$success_message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate credentials
    if ($nickname === $valid_nickname && $password === $valid_password) {
        // Set success message and redirect to admin page
        $_SESSION['success_message'] = "Login berhasil! Selamat datang, Admin.";
        header("Location: admin.html");
        exit();
    } else {
        // Set error message for invalid credentials
        $error_message = "Invalid Nickname or Password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #282c34;
            color: #ffffff;
            margin: 0;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            transition: transform 0.3s ease, background-color 0.3s ease;
            background-color: #3b4049;
            color: #ffffff;
        }
        .login-card:hover {
            transform: translateY(-10px);
            background-color: #494f57;
        }
        .login-card .form-control {
            background-color: #ffffff;
            color: #000000;
        }
        .login-card .form-control:focus {
            background-color: #e8e8e8;
        }
        @keyframes backgroundShift {
            0% {
                background-color: #282c34;
            }
            50% {
                background-color: #353a42;
            }
            100% {
                background-color: #282c34;
            }
        }
        body {
            animation: backgroundShift 10s infinite;
        }
        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login Admin</h3>
                <form method="post" id="loginForm">
                    <div class="mb-3">
                        <label for="inputNick5" class="form-label">Nickname</label>
                        <input type="text" id="inputNick5" name="nickname" class="form-control" aria-describedby="nicknameHelpBlock" required>
                        <div id="nicknameHelpBlock" class="form-text text-light">
                            Your Nickname must be alphabet A-Z, a-z. The first letter must be capitalized.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock" required>
                            <span class="input-group-text toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                        </div>
                        <div id="passwordHelpBlock" class="form-text text-light">
                            Your password must be number, not alphabet minimum 5 word.
                        </div>
                    </div>
                    <?php if ($error_message): ?>
                        <div id="error-message" class="text-danger mb-3"><?= htmlspecialchars($error_message) ?></div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('inputPassword5');
            const passwordFieldType = passwordField.getAttribute('type');
            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
            } else {
                passwordField.setAttribute('type', 'password');
            }
        }
    </script>
</body>
</html>
