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
	$crime_code = $_POST['crime_code'];
	$appeal_status = $_POST['appeal_status'];
    $hearing_date = $_POST['hearing_date'];
	$arresting_officer_badge = $_POST['arresting_officer_badge'];
    $appeal_cutoff_date = $_POST['appeal_cutoff_date'];
	$fine_amount = $_POST['fine_amount'];
	$court_fee = $_POST['court_fee'];
    $amount_paid = $_POST['amount_paid'];
	$payment_due = $_POST['payment_due'];
	$charge_status = $_POST['charge_status'];
    
    // check if crime ID number is unique
    $sql = "SELECT COUNT(*) as count FROM Crimes WHERE crime_id = '$crime_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // crime ID already exists, display error message
        echo "Error: Crime ID already exists.";
    } 
    else {
        // crime ID is unique, insert new criminal record
        $sql = "INSERT INTO Crimes (crime_id, date_charged, classification, crime_code, 
        appeal_status, hearing_date, arresting_officer_badge, appeal_cutoff_date, 
        fine_amount, court_fee, amount_paid, payment_due, charge_status)
        values('$crime_id', '$date_charged', '$classification', '$crime_code', '$appeal_status', 
        '$hearing_date', '$arresting_officer_badge', '$appeal_cutoff_date', '$fine_amount', 
        '$court_fee', '$amount_paid', '$payment_due', '$charge_status')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $crime_id. " entered successfully!";
        }
        $conn->close();
    }
?>