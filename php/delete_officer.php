<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get badge number from AJAX request
$badge_number = $_POST['badge_number'];


// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Officer WHERE badge_number=?");
$stmt->bind_param("i", $badge_number);

// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Officer deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting officer: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>
