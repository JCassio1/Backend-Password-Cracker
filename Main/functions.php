<!-- Functions that main code will use to find passwords -->

<?php

require('database.php');

class Functions {

  Private $salt = "ThisIs-A-Salt123";
  Private $rawFile = "password-wordlist.txt";

  public function ReadFile() {

  }

  public function encryptToMD5($password) {
    $saltedHash = md5($password.$this->salt);
    return $saltedHash;
  }

  public function searchDatabase($searchPassword) {

    try {
      $readDB = Database::connectReadDatabase();
    } catch (\Exception $e) {
      echo "Database connection failed";
    }

    //This func will search for string on password column of database
    try {
      $query = $readDB->prepare('SELECT user_id FROM not_so_smart_users WHERE password = :searchPassword');
      $query->bindParam(':searchPassword', $searchPassword, PDO::PARAM_STR);
      $query->execute();

      $rowCount = $query->rowCount();

      if ($rowCount === 0) {
        echo "No password found";
      }

      $usersArray = array();

      while($row = $query->fetch(PDO::FETCH_ASSOC)) {

        $result = $row['user_id'];
        echo $result;
      }

    } catch (\Exception $e) {
      echo "Error while searcing database";
    }
  }

}

// $callClass = new Functions ;
// $result = $callClass->searchDatabase("afbe97e505ece41e115d007615b662f8");
// echo $result;

 ?>
