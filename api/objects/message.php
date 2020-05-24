<?php
class Message {
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
    $sql = 'select com.id as c_id, com.status as c_status, com.publicationDate as c_publicationDate, com.message as c_message, com.userId as c_userId, user.id as user_id from '.$this->dbtable.' com left join users user on com.userId = user.id order by com.publicationDate desc ';
    // $exec = $this->dbConn->prepare($sql);
    // $exec->execute();
    $exec = $this->dbConn->query($sql);
    
    return $exec;
  }
}