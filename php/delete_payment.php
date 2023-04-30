<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get badge number from AJAX request
$payment_id = $_POST['payment_id'];


// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Payment WHERE payment_id=?");
$stmt->bind_param("i", $payment_id);

// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Payment deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting payment: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>
