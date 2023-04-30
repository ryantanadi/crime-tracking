<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$crime_id = $_POST['crime_id'];
$crime_code = $_POST['crime_code'];

// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Charges SET crime_id=?, crime_code=? WHERE crime_id=? AND crime_code=?");
$stmt->bind_param("ssssi", $crime_id, $crime_code);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Charge updated successfully";
} else {
    echo "Error updating charge: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to charge.html
header('Location: ../html/charge.html');
exit();
?>
