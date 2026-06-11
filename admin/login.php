<?php
session_start();
include '../connect.php'; 

if (isset($_SESSION['admin_id'])) {
    header('Location: users.php'); // Redirect to the first page if already logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $select_admin = mysqli_query($con, "SELECT * FROM `admin` WHERE username = '$username'");

    if (mysqli_num_rows($select_admin) > 0) {
        $admin_data = mysqli_fetch_assoc($select_admin);
        if (password_verify($password, $admin_data['password'])) {
            $_SESSION['admin_id'] = $admin_data['id'];
            header('Location: users.php');
            exit();
        }
    }
    $error_message = "Invalid username or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container { max-width: 400px; margin: 150px auto; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,.1); }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Admin Login</h2>
        <?php if(isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>