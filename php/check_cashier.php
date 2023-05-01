<?php
    // Start session
    session_start();

    // Check if user is logged in and has access level
    if (!isset($_SESSION['username']) || !isset($_SESSION['access_level'])) {
        // Redirect to login page if user is not logged in
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }

    // Check user's access level for cashier
    $access_level = $_SESSION['access_level'];
    if ($access_level != 'admin' && $access_level != 'cashier' && $access_level != 'judge') {
        // Redirect to login page if user has invalid access level
        header('HTTP/1.1 403 Forbidden');
        exit();
    }
?>
