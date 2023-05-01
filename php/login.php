<?php
	// Start session
	session_start();
	require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

	// Check if form was submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Get username and password from form
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		$password = password_hash($password, PASSWORD_DEFAULT);

		// Prepare SQL statement
		$sql = "SELECT * FROM User WHERE username = '$username'";

		// Execute SQL statement
		$result = mysqli_query($conn, $sql);

		// Check if user exists
		if (mysqli_num_rows($result) == 1) {
			// Get user's access level and hashed password
			$user = mysqli_fetch_assoc($result);
			$access_level = $user['access_level'];
			$hashed_password = $user['password'];

			// Verify password
			if (password_verify($_POST['password'], $hashed_password)) {
				// Create session variables
				$_SESSION['username'] = $username;
				$_SESSION['access_level'] = $access_level;

				// Redirect user based on access level

			    header('Location: ../html/Dashboard.html');

				exit();
			} else {
				// Invalid credentials
				$_SESSION['error'] = 'Invalid username or password';
				header('Location: ../html/login.html');
				exit();
			}
		} else {
			// User does not exist
			$_SESSION['error'] = 'Invalid username or password';
			header('Location: ../html/login.html');
			exit();
		}
	}
?>
