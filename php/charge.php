<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve charges by crime ID or crime code
if ((isset($_GET['crime_id']) && $_GET['crime_id'] != "") || (isset($_GET['crime_code']) && $_GET['crime_code'] != "")) {
  // Retrieve the search parameters
  $crime_id = mysqli_real_escape_string($conn, $_GET['crime_id']);
  $crime_code = mysqli_real_escape_string($conn, $_GET['crime_code']);

  // SQL query to retrieve charges
  $sql = "SELECT * FROM Charges WHERE crime_id = $crime_id AND crime_code = $crime_code";

  $result = mysqli_query($conn, $sql);

  // Prepare data in JSON format
  $data = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
} else {
  // Fetch data from Charge table
  $sql = "SELECT * FROM Charges";
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