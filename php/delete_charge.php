<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get badge number from AJAX request
$crime_id = $_POST['crime_id'];
$crime_code = $_POST['crime_code'];

// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Charges WHERE crime_id=? AND crime_code=?");
$stmt->bind_param("i", $crime_id, $crime_code);

// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Charge deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting charge: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>