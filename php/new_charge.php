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
    $crime_code = $_POST['crime_code'];

    // check if record is unique
    $sql = "SELECT COUNT(*) as count FROM Charge WHERE crime_code = '$crime_code' AND crime_id = '$crime_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // record already exists, display error message
        echo "Error: Record already exists.";
    } 
    else {
        // record is unique, insert new record
        $sql = "INSERT INTO Criminal_charge(crime_id, crime_code) values('$crime_id','$crime_code')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Record entered successfully!";
        }
        $conn->close();
    }
    // Select all foreign key IDs from corresponding table for dropdown menu
    function retrieve_crime_codes() {
        global $conn;
        $sql = "SELECT crime_code FROM Crime_codes";
        $result = $conn->query($sql);
        $crime_codes = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $crime_codes[] = $row["crime_code"];
            }
        }
        $conn->close();
        return $crime_codes;    
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