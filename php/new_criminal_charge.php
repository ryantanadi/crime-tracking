<?php
    include "connect.php";
    // Get the values from the form
    $criminal_id = $_POST['criminal_id'];
	$crime_id = $_POST['crime_id'];

    // check if record is unique
    $sql = "SELECT COUNT(*) as count FROM Criminal_charge WHERE criminal_id = '$criminal_id' AND crime_id = '$crime_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // record already exists, display error message
        echo "Error: Record already exists.";
    } 
    else {
        // record is unique, insert new record
        $sql = "INSERT INTO Criminal_charge(criminal_id, crime_id) values('$criminal_id','$crime_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Record entered successfully!";
        }
        $conn->close();
    }
?>