<!-- Code to crack a database that contains 522 rows -->

<?php
require 'crackingMethods.php';

$rawWordFile = "1MillionList.txt";
$numbersRawFile = "numbers-file.txt";
$alphanumericRawFile = "alphanumeric-combination.txt";

$useCracking = new CrackingMethods();

$useCracking->SearchDictionaryPasswords($rawWordFile); //Search dictionary file

// $useCracking->SearchNumberPasswords($numbersRawFile); //Uncomment to Search numbers file
// $useCracking->SearchAlphanumericPasswords($alphanumericRawFile); //Uncoment to Search Alphanumeric file


?>
