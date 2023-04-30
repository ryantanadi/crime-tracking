<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Get the values from the form
    $arrest_id = $_POST['arrest_id'];
	$crime_id = $_POST['crime_id'];
	$badge_number = $_POST['badge_number'];

    // check if arrest ID is unique
    $sql = "SELECT COUNT(*) as count FROM Arrest_info WHERE arrest_id = '$arrest_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // arrest ID already exists, display error message
        echo "Error: Arrest ID already exists.";
    } 
    else {
        // arrest ID is unique, insert new sentencing record
        $sql = "INSERT INTO Arrest_info(arrest_id, crime_id, badge_number) values('$arrest_id','$crime_id','$badge_number')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $arrest_id. " entered successfully!";
        }
        $conn->close();
    }
?>