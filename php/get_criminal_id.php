<?php
  require('functions.php');
  $criminalIDs = retrieve_criminal_ids();
  echo json_encode($criminalIDs);
?>
