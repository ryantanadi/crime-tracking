<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$appeal_id = $_POST['appeal_id'];
$appeal_status = $_POST['appeal_status'];
$hearing_date = $_POST['hearing_date'];
$filing_date = $_POST['filing_date'];
$appeal_count = $_POST['appeal_count'];
$crime_id = $_POST['crime_id'];

// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Appeals SET appeal_status=?, hearing_date=?, filing_date=?, appeal_count=?, crime_id=? WHERE appeal_id=?");
$stmt->bind_param("sssiii", $appeal_status, $hearing_date, $filing_date, $appeal_count, $crime_id ,$appeal_id);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Appeal updated successfully";
} else {
    echo "Error updating appeal: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to officer.html
header('Location: ../html/appeals.html');
exit();
?>
