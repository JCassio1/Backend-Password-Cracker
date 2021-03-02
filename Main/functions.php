<!-- Functions that main code will use to find passwords -->
<?php
require 'database.php';

class Functions {

  private $salt = "ThisIs-A-Salt123"; //Try to call this somehow
  private $callDatabase;

  function __construct() {
    $this->callDatabase = new Database();
  }

  public function encryptToMD5($password) {
    $saltedHash = md5($password.$this->salt);
    return $saltedHash;
  }

  public function searchFile($wordToFind , $rawFile) {

    $listOfWords = fopen($rawFile, "r") or die("Unable to open");

    $originalPassword;

    while(!feof($listOfWords)) {
        $compare = fgets($listOfWords);
        $originalPassword = $compare;
        $hashedListWord = $this->encryptToMD5($originalPassword);
        $hashedWordToFind = $this->encryptToMD5($wordToFind);
        try{$databaseCheck = $this->searchDatabase($hashedListWord, $this->callDatabase);}
        catch(\Exception $e) {echo "Database check failed";}
        $compare = str_replace(array("\r", "\n"), '',$compare);

        $isFound = strcmp($hashedListWord , $hashedWordToFind);

        if($isFound == 0) {
            echo ("Result: \nPassword is $originalPassword and the hashed version is $hashedVersion");
            fclose($listOfWords);
            break;
        } else {
            echo "Not found\n>";
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
    }

    if ($rowCount == 0) {
      echo "No password found";
    }
  }
}

 ?>
