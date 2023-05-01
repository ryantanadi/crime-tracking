<?php
  session_start(); // Start session

  // Unset all session variables
  $_SESSION = array();

  // Destroy session
  session_destroy();

  // Redirect to login page
  header('Location: ../html/login.html');
  exit();
?>
