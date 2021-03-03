<!-- Functions that main code will use to find passwords -->
<?php
require 'database.php';

class Functions {

  private $salt = "ThisIs-A-Salt123";
  private $callDatabase;
  Private $rawFile;

  function __construct() {
    $this->callDatabase = new Database();
  }

  public function encryptToMD5($password) {
    return $saltedHash = md5($password.$this->salt);
  }

  public function searchFile($rawFile) {
    //This func will pick words from file line by line, hash & Salt and search in database func

    $listOfWords = fopen($rawFile, "r") or die("Unable to open");
    $originalPassword;
    $foundCounter = 0;

    //// TODO: Add an array with original password and hashed password

    while(!feof($listOfWords)) {
        $compare = trim(fgets($listOfWords));
        $originalPassword = $compare;
        $hashedFileWord = $this->encryptToMD5($originalPassword);
        $databaseWordCheck = $this->searchDatabase($hashedFileWord);
        $compare = str_replace(array("\r", "\n"), '',$compare);

        $isFound = strcmp($hashedFileWord , $databaseWordCheck); //remove string space

        if($isFound == 0) {
            $foundCounter = $foundCounter + 1;
            echo ("\nResult: Password is $originalPassword and the hashed version is $hashedFileWord\n");
            echo "\n\n!!!---- $foundCounter Matches found ----!!!\n";
        }
    }
    fclose($listOfWords);
    echo "\n\n!!!---End of search---!!!";
  }

  public function searchDatabase($searchPassword) {
    //This func will search for salted hash string on password column of database

    echo "\n searching for:  $searchPassword    in database";

    $sql = 'SELECT password FROM not_so_smart_users WHERE password = :searchPassword';

    $accessDatabase = $this->callDatabase->connectReadDatabase()->prepare($sql);
    $accessDatabase->bindParam(':searchPassword', $searchPassword, PDO::PARAM_STR);
    $accessDatabase->execute();

    $rowCount = $accessDatabase->rowCount();
    $dbResult = $accessDatabase->fetch(PDO::FETCH_ASSOC);

    $foundCounter = 0;

    if ($dbResult) {
      return $dbResult;
    }
  }
}

 ?>
