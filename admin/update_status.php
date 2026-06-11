<?php
// admin/update_status.php

session_start();
include '../connect.php'; 

// Security Check: Only allow logged-in admins
if (!isset($_SESSION['admin_id'])) {
    // Send an error response and stop the script
    http_response_code(403); // Forbidden
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// Check if the request is a POST request and data is present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    
    $order_id = (int)$_POST['order_id'];
    $new_status = mysqli_real_escape_string($con, $_POST['status']);

    // Update the order status in the database
    $query = "UPDATE `orders` SET status = '$new_status' WHERE id = '$order_id'";
    
    if (mysqli_query($con, $query)) {
        // Send a success response back to the browser
        echo json_encode(['success' => true]);
    } else {
        // Send an error response
        http_response_code(500); // Internal Server Error
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }
} else {
    // Send an error if data is missing
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>