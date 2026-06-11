<?php
// We can start the session to make the header's Login/Logout button work correctly
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Terms & Conditions - BookStore</title>
</head>

<body>
  <header class="container-fluid py-3 shadow-lg position-sticky">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-sm-6 col-12">
          <div class="logo text-sm-start text-center">
            <img src="image/logo.png" alt="logo" style="height: 6vh;">
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

  <div class="container py-5">
    <h1 class="mb-4">Terms and Conditions</h1>
    <p class="text-muted">Last updated: October 06, 2025</p>

    <p>Please read these terms and conditions carefully before using Our Service.</p>

    <h2 class="mt-5 h4">1. Agreement to Terms</h2>
    <p>By accessing or using our website, BookStore, you agree to be bound by these Terms and Conditions. If you disagree with any part of the terms, then you may not access the Service.</p>
    
    <h2 class="mt-5 h4">2. User Accounts</h2>
    <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password.</p>

    <h2 class="mt-5 h4">3. Buying and Selling Books</h2>
    
    <h5>For Sellers:</h5>
    <ul>
        <li>You agree that you are the rightful owner of any book you list for sale.</li>
        <li>You must provide an accurate and honest description of the book, including its condition (e.g., 'Like New', 'Good', 'Fair'), title, author, and price.</li>
        <li>You agree to make the book available for delivery once a purchase has been confirmed.</li>
    </ul>

    <h5>For Buyers:</h5>
    <ul>
        <li>You acknowledge that you are purchasing second-hand books, which may show signs of wear and tear.</li>
        <li>It is your responsibility to review all details of a book listing before making a purchase.</li>
    </ul>

    <h2 class="mt-5 h4">4. Orders and Cancellation Policy</h2>
    <p>All sales conducted on the BookStore platform are final. When a buyer places an order, it constitutes a binding agreement.</p>
    <p class="fw-bold">Once an order is placed and confirmed, it cannot be canceled or refunded. This policy is in place to ensure a reliable and firm commitment between the buyer and the seller. Please review your cart and order details carefully before completing your purchase.</p>

    <h2 class="mt-5 h4">5. Prohibited Conduct</h2>
    <p>You agree not to use the Service to:</p>
    <ul>
        <li>List any items that are illegal, stolen, or counterfeit.</li>
        <li>Engage in any fraudulent activity or misrepresent yourself or the items you are selling.</li>
        <li>Harass, abuse, or harm another person.</li>
        <li>Violate any applicable local, state, national, or international law.</li>
    </ul>

    <h2 class="mt-5 h4">6. Limitation of Liability</h2>
    <p>BookStore is a platform that connects buyers and sellers. We are not a party to the transaction between buyer and seller. As such, we are not responsible for the quality, safety, condition, or legality of the books listed. All transactions are made at the user's own risk.</p>

    <h2 class="mt-5 h4">7. Termination</h2>
    <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

    <h2 class="mt-5 h4">8. Governing Law</h2>
    <p>These Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions. Any disputes will be subject to the exclusive jurisdiction of the courts located in Rajkot, Gujarat.</p>

    <h2 class="mt-5 h4">9. Changes to Terms</h2>
    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. We will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
    
    <h2 class="mt-5 h4">10. Contact Us</h2>
    <p>If you have any questions about these Terms, you can contact us at: <a href="mailto:bookstore@gmail.com">bookstore@gmail.com</a>.</p>

  </div>

  <footer class="container-fluid bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© 2025 BookStore | <a href="terms.php" class="text-white">Terms & Conditions</a></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>