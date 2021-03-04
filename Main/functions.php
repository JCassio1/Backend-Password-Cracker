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

  public function setSearchFile($fileToSearch) {
    $this->searchFile($fileToSearch);
  }

  public function encryptToMD5($password) {
    return $saltedHash = md5($password.$this->salt);
  }

  //Appends or prints passwords cracked from text files saved on foundArray
  public function manipulateArray($value, $action) {
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
    //This func will pick words from file line by line and search in func database

    $contentFile = fopen($rawFile, "r") or die("Unable to open");
    $originalPassword;

    while(!feof($contentFile)) {
        $word = trim(fgets($contentFile)); //removes space that can affect MD5 hashing
        $originalPassword = $word;
        $hashedWord = $this->encryptToMD5($originalPassword);
        $userInformation = $this->findOnDatabase($hashedWord, $originalPassword);
        $word = str_replace(array("\r", "\n"), '',$word);

        //compares hashed word with database password
        $isFound = strcmp($hashedWord , $userInformation[1]);

        if($isFound == 0) {
            $this->foundCounter ++;
            $this->manipulateArray("User ID: $userInformation[0] | Password: $originalPassword | Hashed version is $hashedWord", "append");
            echo "\n\n!!!---- $this->foundCounter Matches found ----!!!\n";
            echo ("\nUser ID: $userInformation[0] | Password: $originalPassword | Hashed version is $hashedWord\n");
        }
    }
    fclose($contentFile);
    echo "\n\n!!!---End of search---!!!";
    echo "\n\nSearch results: \n\n";
    echo $this->manipulateArray(null,"print");
  }

  public function findOnDatabase($searchPassword, $notHashedPassword) {
    //This func will search for salted hash strings on password column of database

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

      //returns user id and password if match is found
      return array($userID, $userPassword);
    }
  }
}

 ?>
