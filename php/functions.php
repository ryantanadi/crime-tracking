<?php
require('config.php');

function retrieve_officer_ids() {
    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve badge numbers
    $sql = "SELECT badge_number FROM Officer";

    $result = mysqli_query($conn, $sql);

    // Array to store badge numbers
    $badge_numbers = array();

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($badge_numbers, $row["badge_number"]);
        }
    }

    // Close connection
    mysqli_close($conn);

    return $badge_numbers;
}

function retrieve_crime_ids() {
    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve crime IDs
    $sql = "SELECT crime_id FROM Crimes";

    $result = mysqli_query($conn, $sql);

    // Array to store crime IDs
    $crime_ids = array();

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($crime_ids, $row["crime_id"]);
        }
    }

    // Close connection
    mysqli_close($conn);

    return $crime_ids;
}


function retrieve_criminal_ids() {
    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve criminal IDs
    $sql = "SELECT criminal_id FROM Criminals";

    $result = mysqli_query($conn, $sql);

    // Array to store criminal IDs
    $criminal_ids = array();

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($criminal_ids, $row["criminal_id"]);
        }
    }

    // Close connection
    mysqli_close($conn);

    return $criminal_ids;
}

function retrieve_crime_codes() {
    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve crime codes
    $sql = "SELECT crime_code FROM Crime_codes";

    $result = mysqli_query($conn, $sql);

    // Array to store crime codes
    $crime_codes = array();

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($crime_codes, $row["crime_code"]);
        }
    }

    // Close connection
    mysqli_close($conn);

    return $crime_codes;
}



?>
