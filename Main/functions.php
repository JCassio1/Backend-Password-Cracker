<!-- Functions that main code will use to find passwords -->
<?php
require 'database.php';

class Functions {

  private $salt = "ThisIs-A-Salt123";
  private $callDatabase;
  Private $rawFile;
  Private $foundArray = [];

  Private $foundCounter = 0;

  function __construct() {
    $this->callDatabase = new Database();
  }

  public function encryptToMD5($password) {
    return $saltedHash = md5($password.$this->salt);
  }

  public function manipulateArray($value, $action) {
    //This func will append or display values in array
    switch ($action) {
        case "append":
            array_push($this->foundArray, $value);
          break;

        case "print":
            print_r($this->foundArray);
          break;

        default:
          echo "\nNo array manipulation option chosen";
          break;
    }
  }

  public function searchFile($rawFile) {
    //This func will pick words from file line by line, hash & Salt and search in database func

    $listOfWords = fopen($rawFile, "r") or die("Unable to open");
    $originalPassword;

    while(!feof($listOfWords)) {
        $compare = trim(fgets($listOfWords));
        $originalPassword = $compare;
        $hashedFileWord = $this->encryptToMD5($originalPassword);
        $databaseWordCheck = $this->searchDatabase($hashedFileWord, $originalPassword);
        $compare = str_replace(array("\r", "\n"), '',$compare);

        $isFound = strcmp($hashedFileWord , $databaseWordCheck[1]); //remove string space

        if($isFound == 0) {
            $this->foundCounter ++;
            $this->manipulateArray("User ID: $databaseWordCheck[0] | Password: $originalPassword | Hashed version is $hashedFileWord", "append");
            echo "\n\n!!!---- $this->foundCounter Matches found ----!!!\n";
            echo ("\nUser ID: $databaseWordCheck[0] | Password: $originalPassword | Hashed version is $hashedFileWord\n");
        }
    }
    fclose($listOfWords);
    echo "\n\n!!!---End of search---!!!";
    echo "\n\nSearch results: \n\n";
    echo $this->manipulateArray(null,"print");
  }

  public function searchDatabase($searchPassword, $notHashedPassword) {
    //This func will search for salted hash string on password column of database

    echo "\n searching for: $notHashedPassword | $searchPassword    in database";

    $sql = 'SELECT * FROM not_so_smart_users WHERE password = :searchPassword';

    $accessDatabase = $this->callDatabase->connectReadDatabase()->prepare($sql);
    $accessDatabase->bindParam(':searchPassword', $searchPassword, PDO::PARAM_STR);
    $accessDatabase->execute();

    $rowCount = $accessDatabase->rowCount();
    $dbResult = $accessDatabase->fetch(PDO::FETCH_ASSOC);

    if ($dbResult) {

      $userID = $dbResult['user_id'];
      $userPassword = $dbResult['password'];

      return array($userID, $userPassword);
    }
  }
}

 ?>
