<?php

class Comment extends Base{
  private $dbtable = 'comments';
  
  public function read() {
    $sql = 'select com.id as c_id, com.status as c_status, com.publicationDate as c_publicationDate, com.message as c_message, user.name as user_name from '.$this->dbtable.' com inner join users user on com.userId = user.id order by com.publicationDate desc ';
    $exec = $this->dbconn->prepare($sql);
    $exec->execute();
    return $exec;
  }
}