<?php
require('config.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query the database to retrieve the user's data
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// Verify if the user exists and the password is correct
if (mysqli_num_rows($result) == 1) {
  $user = mysqli_fetch_assoc($result);
  // Password matches, set a session variable and redirect the user
  session_start();
  $_SESSION['username'] = $user['username'];
  header("Location: home.php");
  exit();
} else {
  // Invalid username or password, display an error message
  echo "Invalid username or password";
}

// Close the database connection
mysqli_close($conn);
?>
