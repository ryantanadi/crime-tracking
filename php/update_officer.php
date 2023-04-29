<?php

require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$badge_number = $_POST['badge_number'];
$officer_name = $_POST['officer_name'];
$precinct = $_POST['precinct'];
$phone_contact = $_POST['phone_contact'];
$status = $_POST['status'];


// Prepare and bind update statement
$stmt = $conn->prepare("UPDATE Officer SET officer_name=?, precinct=?, phone_contact=?, status=? WHERE badge_number=?");
$stmt->bind_param("ssssi", $officer_name, $precinct, $phone_contact, $status, $badge_number);

// Execute the update statement
if ($stmt->execute() === TRUE) {
    echo "Officer updated successfully";
} else {
    echo "Error updating officer: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Redirect to officer.html
header('Location: ../html/officer.html');
exit();
?>
