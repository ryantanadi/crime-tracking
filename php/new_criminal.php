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

    // check if criminal ID is unique
    $sql = "SELECT COUNT(*) as count FROM Criminals WHERE criminal_id = '$criminal_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // criminal ID already exists, display error message
        echo "Error: Criminal ID already exists.";
    } 
    else {
        // criminal ID is unique, insert new criminal record
        $sql = "INSERT INTO Criminals (criminal_id, criminal_name, phone_num, address, violent_off_status, probation_status, alias, crime_id)
        values('$criminal_id','$criminal_name','$phone_num','$address','$violent_off_status','$probation_status','$alias','$crime_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $criminal_name. " entered successfully!";
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