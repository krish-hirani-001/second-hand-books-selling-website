<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);

    // Basic validation
    if ($password !== $repassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        // Check if email already exists
        $check_email = mysqli_query($con, "SELECT * FROM `user` WHERE email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email already registered. Please use a different email.');</script>";
        } else {
            // Insert new user into database
            $insert_user = mysqli_query($con, "INSERT INTO `user` (username, email, upassword) VALUES ('$username', '$email', '$password')");
            if ($insert_user) {
                echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Registration failed. Please try again later.');</script>";
            }
        }
    }
}   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css\media.css">
    <link rel="stylesheet" href="style.css">
    <title>BookStore</title>
</head>

<body>
     <header class="container-fluid py-3 shadow-lg position-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="logo text-sm-start text-center">
                        <img src="image\logo.png" alt="logo" style="height: 6vh;">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="nav1">
                        <ul
                            class="d-flex gap-lg-5 gap-sm-4 gap-4 justify-content-sm-end justify-content-center list-unstyled my-sm-0 my-3">
                            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="book.php" class="nav-link">Book</a></li>
                            <li class="nav-item"><a href="sellbook.php" class="nav-link text-nowrap">Sell Book</a></li>
                            <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
                            <li>
                                <a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="bi bi-person-gear"></i>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <li><a class="dropdown-item" href="order.php">My Orders</a></li>
                                  <?php if (isset($_SESSION['user_id'])): ?>
                                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                  <?php else: ?>
                                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                                  <?php endif; ?>
                                  <li><a class="dropdown-item" href="mysellbook.php">mysellbook</a></li>
                                </ul>
                            </li>
                            <li>
                              
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Register Section -->
<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7 col-sm-9">
      <div class="card shadow-lg">
        <div class="card-body p-4">
          <h2 class="text-center mb-3 fw-bold">Create Account</h2>
          <p class="text-center text-muted mb-4">Join BookStore and start buying & selling books today.</p>

          <form method="POST" action="">
            <!-- Full Name -->
            <div class="mb-3">
              <label class="form-label fw-bold">Full Name</label>
              <input type="text" name="username" class="form-control" placeholder="Enter your full name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label fw-bold">Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label class="form-label fw-bold">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label class="form-label fw-bold">Confirm Password</label>
              <input type="password" name="repassword" class="form-control" placeholder="Confirm your password" required>
            </div>

            <!-- Register Button -->
            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-success">Register</button>
            </div>
          </form>

          <!-- Login Link -->
          <p class="text-center mt-4 mb-0">
            Already have an account?
            <a href="login.php" class="fw-bold">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<footer class="container-fluid bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 BookStore | <a href="terms.php" class="text-white">Terms & Conditions</a></p>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
    crossorigin="anonymous"></script>
</html>