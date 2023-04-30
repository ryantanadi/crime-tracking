<?php
  require('functions.php');
  $crimeCodes = retrieve_crime_codes();
  echo json_encode($crimeCodes);
?>
