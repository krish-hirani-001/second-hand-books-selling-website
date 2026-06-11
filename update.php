<?php include 'connect.php'; 
if(isset($_POST['submit'])){
    $id = $_POST['update_id'];
    $title=$_POST['title'];
    $author=$_POST['author'];
    $category=$_POST['category'];
    $condition=$_POST['condition'];
    $price=$_POST['price'];
    $image=$_FILES['image']['name'];
    $image_temp_name=$_FILES['image']['tmp_name'];
    $image_folder='book_img/'.$image;
    $description=$_POST['description'];

    $update_query = mysqli_query($con, "UPDATE `sellbook` SET title='$title', author='$author', category='$category', book_condition='$condition', price='$price', bimage='$image', bdescription='$description' WHERE id='$id'") or die('query failed');
    if($update_query)
    {
        move_uploaded_file($image_temp_name,$image_folder);
        header('location:mysellbook.php');
    }
    else
    {
        echo "error...";
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
      <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold">Update bookch</h2>
                        <p class="text-center text-muted mb-4">
                            Fill in the details of your book and list it for sale.
                            Make sure to provide accurate information for faster selling.
                        </p>
                        <?php
            if (isset($_GET['edit'])) {
              $id = $_GET['edit'];
              $result = mysqli_query($con, "SELECT * FROM sellbook WHERE id=$id");
              $row = mysqli_fetch_assoc($result);
              if($row){
              ?>



                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="update_id" value="<?php echo $row['id'] ?>">
                            <!-- Book Title -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Book Title</label>
                                <input type="text" name="title" class="form-control" required value="<?php echo $row['title']  ?>" >
                            </div>

                            <!-- Author -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Author</label>
                                <input type="text" name="author" class="form-control" required value="<?php echo $row['author']  ?>" >
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    <option>Fiction</option>
                                    <option>Non-Fiction</option>
                                    <option>Education</option>
                                    <option>Novel</option>
                                    <option>Comics</option>
                                </select>
                            </div>

                            <!-- Condition -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Condition</label>
                                <select name="condition" class="form-select" required>
                                    <option value="">-- Select Condition --</option>
                                    <option>Like New</option>
                                    <option>Good</option>
                                    <option>Fair</option>
                                    <option>Old but Usable</option>
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price (₹)</label>
                                <input type="number" name="price" class="form-control" required value="<?php echo $row['price']  ?>">
                            </div>

                            <!-- Upload Image -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Book Image</label>
                                <input type="file" name="image" class="form-control" accept="book_img/*" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button name="submit" type="submit" class="btn btn-primary px-4 py-2">Update Book</button>
                                <button name="submit" type="reset" value="cancel" class="btn btn-success px-4 py-2 mx-sm-3 mt-sm-0 mt-2">Reset</button>
                            </div>
                        </form>
<?php
                                }
                        }
                        
                        ?>
                        

                    </div>
                </div>
            </div>
        </div>
    </section>
  </body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</html>