<?php
	// Start session
	session_start();
    // Start session
	require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

	// Check if form was submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Get username, password, and access level from form
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$access_level = mysqli_real_escape_string($conn, $_POST['access_level']);

		// Hash password
		$password = password_hash($password, PASSWORD_DEFAULT);

		// Prepare SQL statement
		$sql = "INSERT INTO User (username, password, access_level) VALUES ('$username', '$password', '$access_level')";

		// Execute SQL statement
		if (mysqli_query($conn, $sql)) {
			// Registration successful
			$_SESSION['success'] = 'Registration successful. Please login.';
			header('Location: ../html/login.html');
			exit();
		} else {
			// Registration failed
			$_SESSION['error'] = 'Registration failed. Please try again.';
			header('Location: ../html/register.html');
			exit();
		}
	}
?>
