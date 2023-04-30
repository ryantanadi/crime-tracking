<?php

    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Get sentencing ID from AJAX request
    $sentencing_id = $_POST['sentencing_id'];

    // Prepare and bind delete statement
    $stmt = $conn->prepare("DELETE FROM Sentencing WHERE sentencing_id=?");
    $stmt->bind_param("i", $sentencing_id);

    // Execute the delete statement
    if ($stmt->execute() === TRUE) {
        $response = array('status' => 'success', 'message' => 'Sentencing deleted successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Error deleting sentencing: ' . $conn->error);
    }

    // Close connection and send response
    $stmt->close();
    $conn->close();
    echo json_encode($response);
?>