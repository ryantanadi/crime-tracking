<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get badge number from AJAX request
$appeal_id = $_POST['appeal_id'];


// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Appeals WHERE appeal_id=?");
$stmt->bind_param("i", $appeal_id);

// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Appeal deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting appeal: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>
