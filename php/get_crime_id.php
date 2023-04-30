<?php
  require('functions.php');
  $crimeIDs = retrieve_crime_ids();
  echo json_encode($crimeIDs);
?>
