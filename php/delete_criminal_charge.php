<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get badge number from AJAX request
$criminal_id = $_POST['criminal_id'];
$crime_id = $_POST['crime_id'];

// Prepare and bind delete statement
$stmt = $conn->prepare("DELETE FROM Criminal_charge WHERE criminal_id=? AND crime_id=?");
$stmt->bind_param("ii", $criminal_id, $crime_id);


// Execute the delete statement
if ($stmt->execute() === TRUE) {
    $response = array('status' => 'success', 'message' => 'Criminal charge deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Error deleting criminal charge: ' . $conn->error);
}

// Close connection and send response
$stmt->close();
$conn->close();
echo json_encode($response);
?>
