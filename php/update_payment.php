<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$payment_id = $_POST['payment_id'];
$crime_id = $_POST['crime_id'];
$amount_paid = $_POST['amount_paid'];

// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Payment SET crime_id=?, amount_paid=? WHERE payment_id=?");
$stmt->bind_param("ssssi", $crime_id, $amount_paid, $payment_id);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Payment updated successfully";
} else {
    echo "Error updating payment: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to payment.html
header('Location: ../html/payment.html');
exit();
?>
