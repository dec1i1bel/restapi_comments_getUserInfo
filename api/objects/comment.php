<?php
class Comment {
  private $dbConn = null;
  private $dbtable = 'comments';
  
  public $id = null;
  public $status = null;
  public $publicationDate = null;
  public $message = null;
  public $userId = null;
  
  public function __construct($dbConn) {
    $this->dbConn = $dbConn;
  }
  
  public function read() {
    $sql = 'select com.id as c_id, com.status as c_status, com.publicationDate as c_publicationDate, com.message as c_message, user.name as user_name from '.$this->dbtable.' com inner join users user on com.userId = user.id order by com.publicationDate desc ';
    $exec = $this->dbConn->prepare($sql);
    $exec->execute();
    
    return $exec;
  }
}