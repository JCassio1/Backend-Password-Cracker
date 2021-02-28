<?php

/**
 *
 */
class Database
{
  private static $readDatabaseConnection;

  public static function connectReadDatabase() {

  if(self::$readDatabaseConnection === null)

    self::$readDatabaseConnection = new PDO('mysql:host=localhost;dbname=notSoSmartUsers;charset=utf8', 'root', '');
    self::$readDatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$readDatabaseConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return self::$readDatabaseConnection;
  }
}

?>