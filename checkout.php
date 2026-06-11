<?php
session_start();
include 'connect.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $postal_code = mysqli_real_escape_string($con, $_POST['postal_code']);
    $payment_method = mysqli_real_escape_string($con, $_POST['payment']);

    
    $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE email = '$user_email'");
    $total_price = 0;
    $product_list = [];

    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $product_list[] = $cart_item['title'] . ' (₹' . $cart_item['price'] . ')';
            $total_price += $cart_item['price'];
        }
    }

    
    $shipping = 70;
    $platform_charge = 20;
    $grand_total = $total_price + $shipping + $platform_charge;

    $total_products_string = implode(', ', $product_list);

    
    $insert_order_query = "INSERT INTO `orders` (user_email, name, phone, email, address, city, state, postal_code, payment_method, total_products, total_price) VALUES ('$user_email', '$name', '$phone', '$email', '$address', '$city', '$state', '$postal_code', '$payment_method', '$total_products_string', '$grand_total')";
    
    if (mysqli_query($con, $insert_order_query)) {
    
    
    $purchased_books_query = mysqli_query($con, "SELECT * FROM `cart` WHERE email = '$user_email'");
    if(mysqli_num_rows($purchased_books_query) > 0){
        
        while($book = mysqli_fetch_assoc($purchased_books_query)){
            
            $book_title_to_delete = mysqli_real_escape_string($con, $book['title']);
            
            
            mysqli_query($con, "DELETE FROM `sellbook` WHERE title = '$book_title_to_delete'");
        }
    }

    mysqli_query($con, "DELETE FROM `cart` WHERE email = '$user_email'");
    
    $success_message = "Your order has been placed successfully! Thank you for shopping with us. 🙏";

} else {
        $error_message = "Failed to place order. Please try again.";
    }
}


$check_cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE email = '$user_email'");
if (mysqli_num_rows($check_cart_query) == 0 && !isset($success_message)) {
    header('Location: cart.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Checkout | BookStore</title>
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
                                <li><a class="dropdown-item" href="order.php">My Orders</a></li>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                <?php else: ?>
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="#">mysellbook</a></li>
                              </ul>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
      <div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">🧾 Proceed to Checkout</h2>

    <?php
    if (isset($success_message)) {
        echo "<div class='alert alert-success text-center'>$success_message</div>";
        echo "<div class='text-center'><a href='book.php' class='btn btn-primary'>Continue Shopping</a></div>";
    } elseif (isset($error_message)) {
        echo "<div class='alert alert-danger text-center'>$error_message</div>";
    }
    ?>

    <?php if (!isset($success_message)): ?>
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card shadow border-0">
          <div class="card-body">
            <h5 class="card-title mb-3 fw-bold">Billing Details</h5>
            <form action="checkout.php" method="POST">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="fullName" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="example@gmail.com" value="<?php echo htmlspecialchars($user_email); ?>" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Phone Number</label>
                  <input type="tel" name="phone" class="form-control" placeholder="Enter your phone" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">City</label>
                  <input type="text" name="city" class="form-control" placeholder="City" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="3" placeholder="Full address" required></textarea>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">State</label>
                  <input type="text" name="state" class="form-control" placeholder="State" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Postal Code</label>
                  <input type="text" name="postal_code" class="form-control" placeholder="PIN Code" required>
                </div>
              </div>
              <hr>
              <h5 class="fw-bold mb-3">Payment Method</h5>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                <label class="form-check-label" for="cod">Cash on Delivery</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="upi" value="upi">
                <label class="form-check-label" for="upi">UPI / Net Banking</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment" id="card" value="card">
                <label class="form-check-label" for="card">Credit / Debit Card</label>
              </div>
              <div id="payment-details" class="mt-3"></div>
               <button type="submit" class="btn btn-success w-100 py-2 mt-3">Place Order</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card shadow border-0">
          <div class="card-body">
            <h5 class="card-title fw-bold">Order Summary</h5>
            <ul class="list-group list-group-flush mb-3">
              <?php
                $summary_cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE email = '$user_email'");
                $subtotal = 0;
                if (mysqli_num_rows($summary_cart_query) > 0) {
                    while ($item = mysqli_fetch_assoc($summary_cart_query)) {
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>" . htmlspecialchars($item['title']) . "<span>₹" . htmlspecialchars($item['price']) . "</span></li>";
                        $subtotal += $item['price'];
                    }
                }
                $shipping_cost = 70;
                $platform_charges = 20;
                $total_cost = $subtotal + $shipping_cost + $platform_charges;
              ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Subtotal <span>₹<?php echo $subtotal; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Shipping <span>₹<?php echo $shipping_cost; ?></span>
              </li>
               <li class="list-group-item d-flex justify-content-between align-items-center">
                Platform Charge <span>₹<?php echo $platform_charges; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                Total <span class="text-success">₹<?php echo $total_cost; ?></span>
              </li>
            </ul>
           </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
    <script>
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    const paymentDetailsDiv = document.getElementById('payment-details');

    paymentRadios.forEach(radio => {
      radio.addEventListener('change', function() {
        let html = '';
        if (this.value === 'upi') {
          html = `
            <div class="border rounded p-3 bg-light">
              <h6 class="fw-bold mb-2">Scan & Pay</h6>
              <p class="text-muted small mb-2">After payment, your order will be confirmed.</p>
              <img src="image/qr-code.png" alt="UPI QR" class="img-fluid " style="max-width: 150px;">
            </div>`;
        } else if (this.value === 'card') {
          html = `
            <div class="border rounded p-3 bg-light">
              <h6 class="fw-bold mb-2">Enter Credit / Debit Card Details</h6>
              <div class="mb-2">
                <label class="form-label">Card Number</label>
                <input type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <label class="form-label">Expiry Date</label>
                  <input type="text" class="form-control" placeholder="MM/YY">
                </div>
                <div class="col-md-6">
                  <label class="form-label">CVV</label>
                  <input type="password" class="form-control" placeholder="***">
                </div>
              </div>
            </div>`;
        } else {
          html = '';
        }
        paymentDetailsDiv.innerHTML = html;
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>

</body>
</html>