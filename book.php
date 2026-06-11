<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<?php 
include 'connect.php';
$email=$_SESSION['email'];
if(isset($_POST['add_to_cart']))
{
    $book_title=$_POST['book_title'];
    $book_author=$_POST['book_author'];
    $book_price=$_POST['book_price'];
    $book_img=$_POST['book_img'];

    $select_cart=mysqli_query($con, "SELECT * FROM `cart` WHERE title='$book_title' AND email='$email'");
    if(mysqli_num_rows($select_cart) > 0){
        $display_message = "Book already added to cart";
        // echo "<script>alert('Book already added to cart');</script>";
    } else {

    $book_insert=mysqli_query($con, "INSERT INTO `cart`(`title`, `author`, `price`, `img`, `email`) VALUES ('$book_title','$book_author','$book_price','$book_img','$email')");
    $display_message = "Book added to cart successfully";
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
    <section class="container-fluid">
        <div class="container">
            <div class="row g-4 mt-3">
            <?php
        if(isset($display_message))
        {
            echo '
                <div class="message_show" style="background: #9e9191ff; padding: 20px;">
                    <span class="text-light">'.$display_message.' </span>
                    <i class="bi bi-x text-light" onclick="this.parentElement.style.display=\'none\';"></i>
                </div>';
        }
        ?>
            <?php
                $display_product = mysqli_query($con,"SELECT * FROM `sellbook` ORDER BY category");

                if (mysqli_num_rows($display_product) > 0) {
                    $current_category = "";
                    echo '<div class="container">';
                    while ($row = mysqli_fetch_assoc($display_product)) {
                        // if new category, print heading
                        if ($current_category != $row['category']) {
                            if ($current_category != "") {
                                echo "</div>"; // close previous row
                            }
                            $current_category = $row['category'];
                            echo "<h2 class='mt-5 mb-3 text-capitalize'>$current_category</h2>";
                            echo "<hr>";
                            echo "<div class='row g-4'>";
                        }
                        ?>
                        <div class="col-lg-3 col-sm-4 col-12">
                            <div class="card shadow-lg rounded-4 py-3 h-100">
                                <div class="card-body d-flex flex-column text-center">
                                    <img src="book_img/<?php echo $row['bimage']; ?>" alt="book"
                                        class="img-fluid rounded mx-auto d-block" style="max-height:200px; object-fit:contain;">
                                <form action="" method="post">
                                    <div class="px-5 mt-2 text-center">
                                        <p class="card-title small mb-0">
                                            <b class="text-uppercase">Title : </b><?php echo $row['title']; ?>
                                        </p>
                                        <p class="card-text mb-0 small ">
                                            <b class="text-uppercase">Author : </b><?php echo $row['author']; ?>
                                        </p>
                                        <p class="small mb-0 ">
                                            <b class="text-uppercase">Price : </b><?php echo $row['price']; ?>
                                        </p>
                                        <p class="card-text mb-3 small">
                                            <b class="text-uppercase">Condition : </b><?php echo $row['book_condition']; ?>
                                        </p>
                                        <input type="hidden" name="book_title" value="<?php echo $row['title']; ?>">
                                        <input type="hidden" name="book_author" value="<?php echo $row['author']; ?>">
                                        <input type="hidden" name="book_price" value="<?php echo $row['price']; ?>">
                                        <input type="hidden" name="book_img" value="<?php echo $row['bimage']; ?>">
                                    </div>
                                    <button type="submit" name="add_to_cart" class="btn btn-primary mt-auto">Add to Cart</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo "</div></div>"; // close last row & container
                } else {
                    echo "<p>No books found.</p>";
                }
                ?>

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