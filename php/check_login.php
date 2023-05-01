<?php
    // Start session
    session_start();

    // Check if user is logged in and has access level
    if (!isset($_SESSION['username']) || !isset($_SESSION['access_level'])) {
        // Redirect to login page if user is not logged in
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
        // Get the username from the session
    $username = $_SESSION['username'];

    // Return the username in a JSON format
    header('Content-Type: application/json');
    echo json_encode(array('username' => $username));

?>
