<?php

require('database.php');

class Functions {

  Private $salt = "ThisIs-A-Salt123";
  Private $rawFile = "password-wordlist.txt";
  Private $saltedHash;

  public function getSalt() {
    return $this->salt;
  }

  public function ReadFile() {
    $fileHandle = fopen($this->rawFile, "r") or die("Not able to open file");

    if($fileHandle) {
      while (!feof($fileHandle)) {
        $buffer = fgets($fileHandle, 4096);
        echo $buffer;
      }
    }
    fclose($fileHandle);
  }

  public function encryptToMD5($password) {
    $this->saltedHash = md5($password.$this->salt);
    return $this->saltedHash;
  }

}

$callClass = new Functions ;
$result = $callClass->encryptToMD5("Password");
echo $result;

 ?>
