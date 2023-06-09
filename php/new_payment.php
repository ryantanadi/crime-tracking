<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Get the values from the form
    $payment_id = $_POST['payment_id'];
	$crime_id = $_POST['crime_id'];
	$amount_paid = $_POST['amount_paid'];

    // check if payment ID is unique
    $sql = "SELECT COUNT(*) as count FROM Payment WHERE payment_id = '$payment_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // payment ID already exists, display error message
        echo "Error: Payment ID already exists.";
    } 
    else {
        // payment ID is unique, insert new payment record
        $sql = "INSERT INTO Payment(payment_id, crime_id, amount_paid) 
        values('$payment_id','$crime_id','$amount_paid')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $payment_id. " made successfully!";
            $conn->close();
            header("Location: ../html/new_payment.html");
        }
        $conn->close();
    }
    // Select all foreign key IDs from corresponding table for dropdown menu
    function retrieve_crime_ids() {
        global $conn;
        $sql = "SELECT crime_id FROM Crimes";
        $result = $conn->query($sql);
        $crime_ids = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $crime_ids[] = $row["crime_id"];
            }
        }
        $conn->close();
        return $crime_ids;    
    }
?>