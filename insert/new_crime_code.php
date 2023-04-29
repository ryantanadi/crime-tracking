<?php
    include "connect.php";
    // Get the values from the form
    $crime_code = $_POST['crime_code'];
	$crime_name = $_POST['crime_name'];

    // check if crime code is unique
    $sql = "SELECT COUNT(*) as count FROM Crime_codes WHERE crime_code = '$crime_code'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // crime code already exists, display error message
        echo "Error: Crime Code already exists.";
    } 
    else {
        // crime code is unique, insert new sentencing record
        $sql = "INSERT INTO Crime_codes(crime_code, crime_name) values('$crime_code','$crime_name')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $crime_code. " entered successfully!";
        }
        $conn->close();
    }
?>