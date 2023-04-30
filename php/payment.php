<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['payment_id']) && $_GET['payment_id'] != "") {
  // Retrieve the search parameter
  $badge_number = mysqli_real_escape_string($conn, $_GET['payment_id']);

  // Call the stored procedure
  $stmt = mysqli_prepare($conn, "CALL search_payment_by_ID(?)");
  mysqli_stmt_bind_param($stmt, 's', $payment_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  // Prepare data in JSON format
  $data = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }

} else {
  // Fetch data from Payment table
  $sql = "SELECT * FROM Payment";
  $result = $conn->query($sql);

  // Prepare data in JSON format
  $data = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close connection
$conn->close();
?>
