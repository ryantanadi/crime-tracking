<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['criminal_id']) && $_GET['criminal_id'] != "") {
  // Retrieve the search parameter
  $criminal_id = mysqli_real_escape_string($conn, $_GET['criminal_id']);

  $stmt = mysqli_prepare($conn, "SELECT * FROM Criminals WHERE criminal_id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $criminal_id);
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
  // Fetch data from Criminals table
  $sql = "SELECT * FROM Criminals";
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
