<?php
include 'header.php';

// Check if an ID is provided
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>No order ID specified.</div>";
    include 'footer.php';
    exit();
}

$order_id = (int)$_GET['id'];

// Handle form submission for updating the order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $update_query = "UPDATE `orders` SET 
                        name = '$name', 
                        email = '$email', 
                        phone = '$phone', 
                        address = '$address', 
                        status = '$status' 
                    WHERE id = '$order_id'";
                    
    if (mysqli_query($con, $update_query)) {
        header('Location: orders.php');
        exit();
    } else {
        $error_message = "Failed to update order. Please try again.";
    }
}

// Fetch the order details to populate the form
$result = mysqli_query($con, "SELECT * FROM `orders` WHERE id = '$order_id'");
if (mysqli_num_rows($result) > 0) {
    $order = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>Order not found.</div>";
    include 'footer.php';
    exit();
}
?>

<h1 class="mb-4">Edit Order #<?php echo $order['id']; ?></h1>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>

<form action="" method="POST">
    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($order['name']); ?>" required>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($order['email']); ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="tel" name="phone" class="form-control" value="<?php echo htmlspecialchars($order['phone']); ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Shipping Address</label>
        <textarea name="address" class="form-control" rows="3" required><?php echo htmlspecialchars($order['address']); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Order Status</label>
        <select name="status" class="form-select">
            <option value="Pending" <?php if($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Shipped" <?php if($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
            <option value="Delivered" <?php if($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
            <option value="Cancelled" <?php if($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save Changes</button>
    <a href="orders.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'footer.php'; ?>