<?php
    require('config.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Get the values from the form
    $badge_number = $_POST['badge_number'];
	$officer_name = $_POST['officer_name'];
	$precinct = $_POST['precinct'];
	$phone_contact = $_POST['phone_contact'];
	$status = $_POST['status'];

    // check if badge number is unique
    $sql = "SELECT COUNT(*) as count FROM Officer WHERE badge_number = '$badge_number'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // badge number already exists, display error message
        echo "Error: Badge number already exists.";
    } 
    else {
        // badge number is unique, insert new officer record
        $sql = "INSERT INTO Officer (badge_number, officer_name, precinct, phone_contact, status)
        values('$badge_number','$officer_name','$precinct','$phone_contact','$status')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $conn->close();
            header("Location: new_officer.html");
        }
        $conn->close();
    }
?>