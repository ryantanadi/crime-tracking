<?php
    include "connect.php";
    // Get the values from the form
    $criminal_id = $_POST['criminal_id'];
	$criminal_name = $_POST['criminal_name'];
	$phone_num = $_POST['phone_num'];
	$address = $_POST['address'];
	$violent_off_status = $_POST['violent_off_status'];
	$probation_status = $_POST['probation_status'];
	$alias = $_POST['alias'];
	$crime_id = $_POST['crime_id'];

    // check if badge number is unique
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
?>