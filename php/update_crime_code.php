<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$crime_code = $_POST['crime_code'];
$crime_name = $_POST['crime_name'];


// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Crime_codes SET crime_name=? WHERE crime_code=?");
$stmt->bind_param("si", $crime_name,$crime_code);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Crime code updated successfully";
} else {
    echo "Error updating crime code: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to officer.html
header('Location: ../html/crime_code.html');
exit();
?>
