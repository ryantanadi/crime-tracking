<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$arrest_id = $_POST['arrest_id'];
$crime_id = $_POST['crime_id'];
$badge_number = $_POST['badge_number'];

// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Arrest_info SET crime_id=?, badge_number=? WHERE arrest_id=?");
$stmt->bind_param("ssssi", $crime_id, $badge_number, $arrest_id);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Arrest info updated successfully";
} else {
    echo "Error updating arrest info: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to arrest_info.html
header('Location: ../html/arrest_info.html');
exit();
?>
