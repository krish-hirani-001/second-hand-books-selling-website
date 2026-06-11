<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>My Orders | BookStore</title>
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
                        <ul class="d-flex gap-lg-5 gap-sm-4 gap-4 justify-content-sm-end justify-content-center list-unstyled my-sm-0 my-3">
                            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="book.php" class="nav-link">Book</a></li>
                            <li class="nav-item"><a href="sellbook.php" class="nav-link text-nowrap">Sell Book</a></li>
                            <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
                            <li>
                              <a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-gear"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                <li><a class="dropdown-item" href="order.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                <?php else: ?>
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="mysellbook.php">mysellbook</a></li>
                              </ul>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">My Order History</h2>

        <?php
        $order_query = mysqli_query($con, "SELECT * FROM `orders` WHERE user_email = '$user_email' ORDER BY placed_on DESC");

        if (mysqli_num_rows($order_query) > 0) {
            while ($order = mysqli_fetch_assoc($order_query)) {
        ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <div>
                    <strong>Order Placed:</strong> <?php echo date('F j, Y, g:i a', strtotime($order['placed_on'])); ?>
                </div>
                <div>
                    <strong>Status:</strong> <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($order['status']); ?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Order Details</h5>
                        <p class="mb-1"><strong>Products:</strong> <?php echo htmlspecialchars($order['total_products']); ?></p>
                        <p class="mb-1"><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                        <p class="mb-1"><strong>Total Amount:</strong> <span class="fw-bold text-success">₹<?php echo htmlspecialchars($order['total_price']); ?></span></p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Shipping Address</h5>
                        <p class="mb-1"><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                        <p class="mb-1"><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['city']); ?>, <?php echo htmlspecialchars($order['state']); ?> - <?php echo htmlspecialchars($order['postal_code']); ?></p>
                        <p class="mb-1"><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='alert alert-info text-center'>You have not placed any orders yet. <a href='book.php' class='alert-link'>Start shopping now!</a></div>";
        }
        ?>
    </div>

    <footer class="container-fluid bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 BookStore | <a href="terms.php" class="text-white">Terms & Conditions</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
</body>

</html>