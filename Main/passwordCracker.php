<!-- Code to crack a database that contains 522 rows -->

<?php
require 'functions.php';

$rawWordFile = "1MillionList.txt";
$numbersRawFile = "numbers-file.txt";
$alphanumericRawFile = "alphanumeric-combination.txt";

$callFunction = new Functions();
$callFunction->searchFile($alphanumericRawFile);

?>
