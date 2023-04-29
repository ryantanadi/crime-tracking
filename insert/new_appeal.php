<?php
    include "connect.php";
    // Get the values from the form
    $appeal_id = $_POST['appeal_id'];
    $appeal_status = $_POST['appeal_status'];
    $hearing_date = $_POST['hearing_date'];
    $filing_date = $_POST['filing_date'];
    $appeal_count = $_POST['appeal_count'];
    $crime_id = $_POST['crime_id'];

    // check if appeal ID is unique
    $sql = "SELECT COUNT(*) as count FROM Appeals WHERE appeal_id = '$appeal_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // appeal ID already exists, display error message
        echo "Error: Appeal ID already exists.";
    } 
    else {
        // appeal ID is unique, insert new sentencing record
        $sql = "INSERT INTO Appeals (appeal_id, appeal_status, hearing_date, filing_date, appeal_count, crime_id)
        values('$appeal_id','$appeal_status','$hearing_date','$filing_date','$appeal_count','$crime_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $appeal_id. " entered successfully!";
        }
        $conn->close();
    }
    // Select all crime IDs from Crimes table for dropdown menu
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
    $conn->close();
?>