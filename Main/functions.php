<?php

require('database.php');

class Functions {

  Private $salt = "ThisIs-A-Salt123";
  Private $rawFile = "password-wordlist.txt";

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

}

$callClass = new Functions ;
$result = $callClass->ReadFile();

 ?>
