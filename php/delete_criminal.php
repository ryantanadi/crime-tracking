<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get criminal ID from AJAX request
$criminal_id = $_POST['criminal_id'];

// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Criminals WHERE criminal_id=?");
$stmt->bind_param("i", $criminal_id);

// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Criminal deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting criminal: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>
