<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the values from the form
    $criminal_id = $_POST['criminal_id'];
    $criminal_name = $_POST['criminal_name'];
    $phone_num = $_POST['phone_num'];
    $address = $_POST['address'];
    $violent_off_status = $_POST['violent_off_status'];
    $probation_status = $_POST['probation_status'];
    $alias = $_POST['alias'];
    $crime_id = $_POST['crime_id'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE Criminals SET criminal_name=?, phone_num=?, address=?, violent_off_status=?, probation_status=?, alias=?, crime_id=? WHERE criminal_id=?");
    $stmt->bind_param("ssssssii", $criminal_name, $phone_num, $address, $violent_off_status, $probation_status, $alias, $crime_id, $criminal_id);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        echo "Criminal updated successfully";
    } else {
        echo "Error updating criminal: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();

    // Redirect to criminals.html
    header('Location: ../html/criminals.html');
    exit();
?>
