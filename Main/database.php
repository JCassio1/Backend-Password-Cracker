<?php
// Connecting to MySQL database
/**
 *
 */
 class Database
 {
   private $readDatabaseConnection;
   private $serverName;
   private $dbUsername;
   private $dbPassword;
   private $dbName;
   private $charset;

   public function connectReadDatabase() {
     $this->serverName = "127.0.0.1";
     $this->dbUsername = "root";
     $this->dbPassword = "";
     $this->dbName = "notSoSmartUsers";
     $this->charset = "utf8";

     try {
       $connectionParams = "mysql:host=".$this->serverName.";dbname=".$this->dbName.";charset=".$this->charset;
       $pdo = new PDO($connectionParams, $this->dbUsername, $this->dbPassword);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

       return $pdo;
     } catch (PDOException $e) {
       echo "Database connection unsuccessful".$e->getMessage();
     }
   }
 }
