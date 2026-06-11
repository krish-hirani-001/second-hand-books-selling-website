<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php 
include 'connect.php';
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    header('location:cart.php');
}
if(isset($_GET['remove_all'])){
    mysqli_query($con, "DELETE FROM `cart`");
    header('location:cart.php');
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
    <!-- Cart Section -->
<div class="container py-5">
    <h2 class="mb-4 text-center">Your Shopping Cart</h2>

    <!-- Cart Table -->
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center bg-white">
        <?php
        $email = $_SESSION['email'];
        $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE email = '$email'");
        $subtotal = 0;
        if(mysqli_num_rows($cart_query) > 0){
            echo "<thead class='table-dark'>
                  <tr>
                    <th>Book Image</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>";
                while($cart_item = mysqli_fetch_assoc($cart_query)){
                    ?>
                    <tr>
                      <td><img src="book_img/<?php echo $cart_item['img']; ?>" alt="Book" class="img-fluid" style="width:70px;"></td>
                      <td><?php echo $cart_item['title']; ?></td>
                      <td><?php echo $cart_item['author']; ?></td>
                      <td>₹<?php echo $cart_item['price']; ?></td>
                      <td><a href="cart.php?remove=<?php echo $cart_item['id'];?>" class="btn btn-danger btn-sm">Remove</a></td>
                    </tr>
<?php
                    $subtotal += $cart_item['price'];
                }
        }
        else{
          echo "<p class='text-center'>Your cart is empty.</p>";
        }
        ?>
        
          <!-- Example Row -->
          
          <!-- Repeat rows dynamically with PHP -->
        </tbody>
      </table>
    </div>
<?php
  if($subtotal > 0){
    ?>
<a href="cart.php?remove_all" class="btn btn-danger btn-sm">Remove all</a>
<?php
$Shipping=70;
$platform_charge=20;
$total=$subtotal+$Shipping+$platform_charge;
    echo "<div class='row mt-4 justify-content-center'>
      <div class='col-md-6'>
        <div class='card shadow'>
          <div class='card-body'>
            <h5 class='card-title'>Cart Summary</h5>
            <p class='mb-1'>Subtotal: <span class='fw-bold'>$subtotal</span></p>
            <p class='mb-1'>Shipping: <span class='fw-bold'>$Shipping</span></p>
            <p class='mb-1'>platform charge: <span class='fw-bold'>$platform_charge</span></p>
            <hr>
            <p class='mb-3'>Total: <span class='fw-bold text-success'>$total</span></p>
            <a href='checkout.php' class='btn btn-success w-100'>Proceed to Checkout</a>
          </div>
        </div>
      </div>
    </div>";
  }
?>

    <!-- Cart Summary -->
    
  </div>

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