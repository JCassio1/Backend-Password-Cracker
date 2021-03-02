<!-- Functions that main code will use to find passwords -->
<?php
require 'database.php';

class Functions {

  private $salt = "ThisIs-A-Salt123"; //Try to call this somehow
  private $callDatabase;
  Private $rawFile;

  function __construct() {
    $this->callDatabase = new Database();
  }

  public function encryptToMD5($password) {
    $saltedHash = md5($password.$this->salt);
    return $saltedHash;
  }

  public function searchFile($rawFile) {

    $listOfWords = fopen($rawFile, "r") or die("Unable to open");


    $originalPassword;

    while(!feof($listOfWords)) {
        $compare = fgets($listOfWords);
        $originalPassword = $compare;
        $hashedFileWord = $this->encryptToMD5($originalPassword);
        $databaseWordCheck = $this->searchDatabase($hashedFileWord);
        $compare = str_replace(array("\r", "\n"), '',$compare);

        $isFound = strcmp($hashedFileWord , $databaseWordCheck);

        if($isFound == 0) {
            echo ("Result: \nPassword is $originalPassword and the hashed version is $hashedVersion");
            fclose($listOfWords);
            break;
        } else {
            echo "\nNot found>";
        }
    }
  }

  public function searchDatabase($searchPassword) {
    //This func will search for string on password column of database

    $sql = 'SELECT user_id FROM not_so_smart_users WHERE password = :searchPassword';

    $accessDatabase = $this->callDatabase->connectReadDatabase()->prepare($sql);
    $accessDatabase->bindParam(':searchPassword', $searchPassword, PDO::PARAM_STR);
    $accessDatabase->execute();

    $rowCount = $accessDatabase->rowCount();

    $usersArray = array();

    while($row = $accessDatabase->fetch(PDO::FETCH_ASSOC)) {

      $result = $row['user_id'];
      echo $result;
      return $result;
    }

    if ($rowCount == 0) {
      echo "\nNo password found";
      return "Nothing";
    }
  }
}

 ?>
