<?php 
include 'header.php'; 

// The old PHP logic for updating status has been REMOVED from here.
// It is now handled by update_status.php

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    mysqli_query($con, "DELETE FROM `orders` WHERE id = '$delete_id'");
    header('Location: orders.php');
    exit();
}
?>

<h1 class="mb-4">Order Details</h1>

<div id="feedback-message" class="alert alert-success" style="display:none; position: fixed; top: 80px; right: 20px; z-index: 1050;">
    Status Saved!
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Products</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($con, "SELECT * FROM `orders` ORDER BY placed_on DESC");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['total_products']); ?></td>
                <td>₹<?php echo $row['total_price']; ?></td>
                <td>
                    <select class="form-select" onchange="updateStatus(this)" data-orderid="<?php echo $row['id']; ?>">
                        <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Shipped" <?php if($row['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="Delivered" <?php if($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                        <option value="Cancelled" <?php if($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                </td>
                <td>
                    <?php if ($row['status'] == 'Pending'): ?>
                        <a href="edit_order.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <?php endif; ?>
                    <a href="orders.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function updateStatus(selectElement) {
    const orderId = selectElement.dataset.orderid;
    const newStatus = selectElement.value;
    const feedbackMessage = document.getElementById('feedback-message');

    // Send the data to the server in the background
    fetch('update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `order_id=${orderId}&status=${newStatus}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show a "Saved!" message for 2 seconds
            feedbackMessage.style.display = 'block';
            setTimeout(() => {
                feedbackMessage.style.display = 'none';
            }, 2000);

            // If you want to hide the Edit button instantly when status is no longer 'Pending'
            // you can add that logic here. For now, it updates on next page load.
        } else {
            alert('Error updating status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        alert('An error occurred. Please check the console.');
    });
}
</script>
<?php include 'footer.php'; ?>