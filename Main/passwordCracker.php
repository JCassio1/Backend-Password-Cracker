<!-- Code to crack a database that contains 522 rows -->

<?php
require 'functions.php';

$callFunction = new Functions;

$rawWordFile = "1MillionList.txt";

$callFunction->searchFile($rawWordFile);

?>
