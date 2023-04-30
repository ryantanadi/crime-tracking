<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['criminal_id']) && $_GET['criminal_id'] != "" && isset($_GET['crime_id']) && $_GET['crime_id'] != "") {
    // Retrieve the search parameters
    $criminal_id = mysqli_real_escape_string($conn, $_GET['criminal_id']);
    $crime_id = mysqli_real_escape_string($conn, $_GET['crime_id']);

     // Execute the query
    $query = "SELECT * FROM Criminal_charge WHERE criminal_id = '$criminal_id' AND crime_id = '$crime_id'";
    $result = mysqli_query($conn, $query);

    // Prepare data in JSON format
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

}else {
  // Fetch data from Officer table
  $sql = "SELECT * FROM Criminal_charge";
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
