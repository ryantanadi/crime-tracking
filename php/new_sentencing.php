<?php
    include "connect.php";
    // Get the values from the form
    $sentencing_id = $_POST['sentencing_id'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$sentence_type = $_POST['sentence_type'];
	$num_violations = $_POST['num_violations'];
    $criminal_id = $_POST['criminal_id'];

    // check if sentencing ID is unique
    $sql = "SELECT COUNT(*) as count FROM Sentencing WHERE sentencing_id = '$sentencing_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // sentencing ID already exists, display error message
        echo "Error: Sentencing ID already exists.";
    } 
    else {
        // sentencing ID is unique, insert new sentencing record
        $sql = "INSERT INTO Sentencing (sentencing_id, start_date, end_date, sentence_type, num_violations, criminal_id)
        values('$sentencing_id','$start_date','$end_date','$sentence_type','$num_violations','$criminal_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $sentencing_id. " entered successfully!";
        }
        $conn->close();
    }
?>