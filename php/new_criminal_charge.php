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
	$crime_id = $_POST['crime_id'];

    // check if record is unique
    $sql = "SELECT COUNT(*) as count FROM Criminal_charge WHERE criminal_id = $criminal_id AND crime_id = $crime_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // record already exists, display error message
        echo "Error: Record already exists.";
        $conn->close();
        header("Location: ../html/new_criminal_charge.html");
    } 
    else {
        // record is unique, insert new record
        $sql = "INSERT INTO Criminal_charge(criminal_id, crime_id) values($criminal_id,$crime_id)";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Record entered successfully!";
            $conn->close();
            header("Location: ../html/new_criminal_charge.html");

        }
        $conn->close();
    }

?>