<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the values from the form
    $sentencing_id = $_POST['sentencing_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $sentence_type = $_POST['sentence_type'];
    $num_violations = $_POST['num_violations'];
    $criminal_id = $_POST['criminal_id'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE Sentencing SET start_date=?, end_date=?, sentence_type=?, num_violations=?, criminal_id=? WHERE sentencing_id=?");
    $stmt->bind_param("sssiii", $start_date, $end_date, $sentence_type, $num_violations, $criminal_id, $sentencing_id);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        echo "Sentencing updated successfully";
    } else {
        echo "Error updating sentencing: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();

    // Redirect to sentencing.html
    header('Location: ../html/sentencing.html');
    exit();
?>
