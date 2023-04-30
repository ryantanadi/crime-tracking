<?php
  require('functions.php');
  $badgeNumbers = retrieve_officer_ids();
  echo json_encode($badgeNumbers);
?>
