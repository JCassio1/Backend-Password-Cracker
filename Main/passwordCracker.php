<!-- Code to crack a database that contains 522 rows -->

<?php

require('functions.php');

try {
  $readDB = Database::connectReadDatabase();
} catch (\Exception $e) {
  echo "Database connection failed";
}

try {
  $query = $readDB->prepare('SELECT * FROM not_so_smart_users');
  $query->execute();

  $rowCount = $query->rowCount();

  if ($rowCount === 0) {
    echo "No rows found";
  }

  else {
    echo $rowCount;
  }

  $usersArray = array();

  while($row = $query->fetch(PDO::FETCH_ASSOC)) {

    $result = $row['user_id'];
    echo $result;

  }

} catch (\Exception $e) {
  echo "Error fetching data";
}
 ?>
