<!-- Methods to crack a database that contains 522 rows -->
<?php

include 'functions.php';
/**
 *
 */
class CrackingMethods extends Functions
{

// Searches on their respective text files. Functionality can be extended on methods based on need.

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
