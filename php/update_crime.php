<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    // Get the values from the form
    $crime_id = $_POST['crime_id'];
	$date_charged = $_POST['date_charged'];
	$classification = $_POST['classification'];
	$appeal_status = $_POST['appeal_status'];
    $hearing_date = $_POST['hearing_date'];
	$arresting_officer_badge = $_POST['badge_number'];
    $appeal_cutoff_date = $_POST['appeal_cutoff_date'];
	$fine_amount = $_POST['fine_amount'];
	$court_fee = $_POST['court_fee'];
    $amount_paid = $_POST['amount_paid'];
	$payment_due = $_POST['payment_due'];
	$charge_status = $_POST['charge_status'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE Crimes SET date_charged=?, classification=?,  appeal_status=?, hearing_date=?, arresting_officer_badge=?, appeal_cutoff_date=?, fine_amount=?, court_fee=?, amount_paid=?, payment_due=?, charge_status=? WHERE crime_id=?");
    $stmt->bind_param("sssssssssssi", $date_charged, $classification, $appeal_status, $hearing_date, $arresting_officer_badge, $appeal_cutoff_date, $fine_amount, $court_fee, $amount_paid, $payment_due, $charge_status, $crime_id);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        echo "Crime updated successfully";
    } else {
        echo "Error updating crime: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();

    // Redirect to crime.html
    header('Location: ../html/crime.html');
    exit();

?>