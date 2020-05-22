<?php
class Message {
  private $dbconn;
  private $dbtable = 'comments';
  
  public $id;
  public $status;
  public $publicationDate;
  public $message;
  public $userId;
  
  public function __construct($dbconn) {
    $this->dbconn = $dbconn;
  }
  
  public function read() {
    $sql = '
      select
        com.id as c_id,
        com.status as c_status,
        com.publicationDate as c_publicationDate,
        com.message as c_message,
        com.userId as c_userId,
        user.id as user_id
      from 
        '.$this->dbtable.' com
      left join 
        users user
          on com.userId = user.id
      order by
        com.publicationDate desc
    ';
    $exec = $this->conn->prepare($sql);
    $exec->execute();
    
    return $exec;
  }
}