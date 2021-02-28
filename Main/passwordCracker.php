<!-- Code to crack a database that contains 522 rows -->

<?php

require("functions.php");

$callFunction = new Functions();

$rawFile = "1MillionList.txt";

$wordToFind = "cg451686";
$listOfWords = fopen($rawFile, "r") or die("Unable to open");

$originalPassword;

while(!feof($listOfWords)) {
    $compare = fgets($listOfWords);
    $compare = str_replace(array("\r", "\n"), '',$compare);
    $isFound = strcmp($compare , $wordToFind);

    if($isFound == 0) {
        echo ("Found it!\n");
        $originalPassword = 0;
        fclose($listOfWords);
        break;
    } else {
        echo "Not found\n>";
    }
}
 ?>
