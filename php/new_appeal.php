<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
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
            $conn->close();
            header("Location: ../html/new_appeal.html");
        }
        $conn->close();
    }

?>