<?php

//password for all users is (password)
class Database {

  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $stmt;
  private $dbh;
  private $error;

  //Connection to database
  public function __construct(){

    $db = "mysql:host=".$this->host.";dbname=".$this->dbname;

    $options = array(

      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

    );

    try{

      $this->dbh = new PDO($db, $this->user, $this->pass, $options);

    }catch(PDOException $e){

      $this->error = $e->getMessage();
      echo $this->error;

    }

  }

  //prepare Statemant
  public function query($sql){

    $this->stmt = $this->dbh->prepare($sql);

  }

  //bind Params
  public function bind($param, $value, $type = null){

    if(is_null($type))
    {

      switch(true)
      {

        case is_int($value):
          $type = PDO::PARAM_INT;
        break;

        case is_bool($value):
          $type = PDO::PARAM_BOOL;
        break;

        case is_null($value):
          $type = PDO::PARAM_NULL;
        break;

        default:
          $type = PDO::PARAM_STR;

      }

    }

    $this->stmt->bindValue($param, $value, $type);

  }


  //execute statemant
  public function execute(){

    return $this->stmt->execute();

  }

  //return result set in array
  public function resultSet(){

    $this->execute();

    return $this->stmt->fetchAll(PDO::FETCH_OBJ);

  }

  //return single row
  public function single(){

    $this->execute();

    return $this->stmt->fetch(PDO::FETCH_OBJ);

  }

  //get row count of resutl
  public function rowCount(){

    return $this->stmt->rowCount();

  }

}

 ?>
