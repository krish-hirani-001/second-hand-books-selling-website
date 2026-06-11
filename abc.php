<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
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
  <link rel="stylesheet" href="css/media.css">
  <link rel="stylesheet" href="style.css">
  <title>BookStore</title>
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
              <li class="nav-item"><a href="abc.php" class="nav-link">Home</a></li>
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
              <li>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>


  <section class="container-fluid">
    <div class="container">
      <div class="row align-items-center mt-5">
        <div class="col-lg-6 text-lg-start text-center">
          <div class="bennercontent">
            <h1>Buy & Sell Second-Hand Books Easily</h1>
            <h4 class="mt-3 fs-6">Find your next read at an affordable price or give your old books a new home.</h4>
            <button type="button" class="btn button btn-dark mt-3" onclick="">See Book</button>
          </div>
        </div>
        <div class="col-lg-6 text-center mt-lg-0 mt-4">
          <img src="image/Man_reading_book_character_illustration_generated-removebg-preview.png" alt="home"
            class="img-fluid" style="height: 25vw; box-shadow: rgba(0, 0, 0, 0.2) 0px 60px 40px -7px;">
        </div>
      </div>
    </div>
  </section>


  <section class="container-fluid bg-white mt-5">
    <div class="container">
      <h1 class="text-center py-5 ">
        What We Offer For Our Readers
      </h1>
      <div class="row ">
        <div class="col-sm-4 col-12 mb-5">
          <div class="text-center p-4 shadow-lg">
            <img src="image/buy_book_icon1.png" alt="icon" class="img-fluid" style="height: 10vh;">
            <h5 class="fw-bold">Buy Books</h5>
            <p class="text-muted">Browse thousands of second-hand books at unbeatable prices.</p>
            <a href="book.php" class="btn btn-primary btn-sm mt-2">Explore</a>
          </div>
        </div>
        <div class="col-sm-4 col-12">
          <div class="text-center p-4 shadow-lg">
            <img src="image/selling_book_icon.png" alt="icon" class="img-fluid my-2" style="height: 8vh;">
            <h5 class="fw-bold">Sell Your Books</h5>
            <p class="text-muted">Easily list your old books and earn <br>money quickly.</p>
            <a href="sellbook.php" class="btn btn-primary btn-sm mt-2">Explore</a>
          </div>
        </div>
        <div class="col-sm-4 col-12">
          <div class="text-center p-4 shadow-lg">
            <img src="image/buy_book_icon.png" alt="icon" class="img-fluid" style="height: 10vh;">
            <h5 class="fw-bold">Book Exchange</h5>
            <p class="text-muted">Swap your books with other readers and discover new stories.</p>
            <a href="book.php" class="btn btn-primary btn-sm mt-2">Explore</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="container-fluid py-5 ">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold">Browse By Categories</h2>
      <div class="row g-4">


        <div class="col-lg-3 col-sm-6 col-12 ">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body hhh">
              <img src="image/fiction_book.png" alt="Fiction" class="img-fluid mb-3" style="height: 70px;">
              <h6 class="fw-bold">Fiction</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro id soluta saepe sapiente in nobis.</p>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body hhh">
              <img src="image/education_book.png" alt="Education" class="img-fluid mb-3" style="height: 70px;">
              <h6 class="fw-bold">Education</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ipsam, exercitationem accusamus
                corporis cum in!</p>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body hhh">
              <img src="image/novels_book.png" alt="Novels" class="img-fluid mb-3" style="height: 70px;">
              <h6 class="fw-bold">Novels</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi distinctio cum illo assumenda ipsam
                facilis.</p>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body hhh">
              <img src="image/Science_Technology_book.png" alt="Science" class="img-fluid mb-3" style="height: 70px;">
              <h6 class="fw-bold">Science & Technology</h6>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque non facilis exercitationem dolorem
                mollitia molestiae!</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="container-fluid bg-white py-5">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold">Why Choose Us?</h2>
      <div class="row text-center g-4">

        <div class="col-md-4">
          <div class="p-4 shadow-sm h-100">
            <img src="image/trust.png" alt="Trust" class="mb-3" style="height:60px;">
            <h6 class="fw-bold">Trusted by Students</h6>
            <p class="text-muted">Thousands of students and book lovers buy & sell books on our platform daily.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 shadow-sm h-100">
            <img src="image/affordable1.png" alt="Affordable" class="mb-3" style="height:60px;">
            <h6 class="fw-bold">Affordable Prices</h6>
            <p class="text-muted">Get your favorite books for up to 70% less than the original price.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 shadow-sm h-100">
            <img src="image/fast_delivery.png" alt="Fast Delivery" class="mb-3" style="height:60px;">
            <h6 class="fw-bold">Fast Delivery</h6>
            <p class="text-muted">Quick and reliable delivery right to your doorstep.</p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="container-fluid py-5">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold">What Our Readers Say</h2>
      <div class="row g-4">

        <div class="col-md-4">
          <div class="p-4 shadow-lg h-100">
            <p class="text-muted">“This website helped me find affordable textbooks for my semester. Highly recommend!”
            </p>
            <h6 class="fw-bold mt-3">– Rohan Mehta</h6>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 shadow-lg h-100">
            <p class="text-muted">“Selling my old books was so easy. I earned money and helped others save too.”</p>
            <h6 class="fw-bold mt-3">– Priya Sharma</h6>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 shadow-lg h-100">
            <p class="text-muted">“I swapped novels with other readers, now I have a fresh collection without spending
              much.”</p>
            <h6 class="fw-bold mt-3">– Ankit Patel</h6>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="container-fluid bg-dark abc text-white py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-3" style="color: azure;">Stay Updated</h2>
      <p class="mb-4">Subscribe to our newsletter and never miss out on new arrivals & offers.</p>
      <form class="d-flex justify-content-center">
        <input type="email" class="form-control w-50 me-2" placeholder="Enter your email">
        <button class="btn btn-warning">Subscribe</button>
      </form>
    </div>
  </section>



</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</html>