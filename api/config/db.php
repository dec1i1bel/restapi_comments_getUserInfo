<?php
class Db {
  private $dsn = 'mysql:host=127.0.0.1:3306;dbname=restapi_userinfo_comments;charset=UTF8';
  private $username = 'root';
  private $password = '';
  public $conn;
  
  public function getConnection() {
    $this->conn = null;
    
    
    try {
      $this->conn = new PDO($this->dsn, $this->username, $this->password);
    } catch(PDOException $ex) {
      echo 'Connection error: '.$ex->getMessage();
    }
    
    return $this->conn;
  }
}