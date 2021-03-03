<?php

include 'functions.php';
/**
 *
 */
class CrackingMethods extends Functions
{

public function SearchNumberPasswords($rawTextFile)
{
  $this->setSearchFile($rawTextFile);
}

public function SearchAlphanumericPasswords($rawTextFile)
{
  $this->setSearchFile($rawTextFile);
}

public function SearchDictionaryPasswords($rawTextFile)
{
  $this->setSearchFile($rawTextFile);
}

public function SearchMixedCharsPasswords($rawTextFile)
{
  $this->setSearchFile($rawTextFile);
}

}




 ?>
