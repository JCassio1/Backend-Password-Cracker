<?php

require('database.php');

try {
  $database = new Database;
  $database->connectReadDatabase();
  echo "Database connection succesful";

} catch (\Exception $e) {
  echo "Connection test failed $e";
}

?>
