<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
include 'connect.php';
$email = $_SESSION['email'];
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM `sellbook` WHERE id = '$delete_id'");
    header('location:mysellbook.php');
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
 <div class="container py-5">
    <h2 class="mb-4 text-center">Your Sell Book</h2>

    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center bg-white">
        <thead class="table-dark">
          <tr>
            <th class="text-nowrap">Book Image</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>condition</th>
            <th>category</th>
            <th>description</th>
            <th>Remove/update</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sellbook_query = mysqli_query($con, "SELECT * FROM `sellbook` WHERE email = '$email'");
          if (mysqli_num_rows($sellbook_query) > 0) {
                while ($row = mysqli_fetch_assoc($sellbook_query)) {
                    ?>
                <tr>
                    <td><img src="book_img/<?php echo $row['bimage']  ?>" alt="Book" class="img-fluid" style="width:70px;"></td>
                    <td><?php echo $row['title']  ?></td>
                    <td><?php echo $row['author']  ?></td>
                    <td>₹<?php echo $row['price']  ?></td>
                    <td><?php echo $row['book_condition']  ?></td>
                    <td><?php echo $row['category']  ?></td>
                    <td><?php echo $row['bdescription']  ?></td>

                    <td><a href="mysellbook.php?delete=<?php echo $row['id']?>" onclick="return confirm('are you sure want to delete this book?')"><i class="bi bi-trash text-black"></i></a>
                    <a href="update.php?edit=<?php echo $row['id']?>"><img src="image/edit.png" alt="" class="ms-3" style="width:15px;"></a>
                    </td>
                </tr>
<?php
                }
            }else {
                echo '<tr><td colspan="8">No books found in your sell list</td></tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</html>