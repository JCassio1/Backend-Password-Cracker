<?php

require('database.php');

try {
  echo "Connection test successful";
  $readDatabase = Database::connectReadDatabase();


} catch (\Exception $e) {
  echo "Connection test failed $e";
}

?>
