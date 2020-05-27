<?php

class Comment extends Base{
  private $dbtable = 'comments';
  
  public function read() {
    $sql = 'select
              com.id as c_id,
              com.status as c_status,
              com.status_id as c_status_id,
              com.publicationDate as c_publicationDate,
              com.message as c_message
            from '.$this->dbtable.' com
              inner join
                users user
                  on com.userId = user.id
            order by
              com.publicationDate desc';
    $exec = $this->dbconn->prepare($sql);
    $exec->execute();
    return $exec;
  }
  
  public function update($comment_id, $strStatus, $strStatus_id) {
    $sql = 'update table
              set
                status = :strStatus,
                status_id = :strStatus_id,
              where
                id = :comment_id';
    $exec = $this->dbconn->prepare($sql);
    $exec->bindValue(':strStatus', $strStatus, PDO::PARAM_STR);
    $exec->bindValue(':strStatus_id', $strStatus_id, PDO::PARAM_STR);
    $exec->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
  }

  public function delete() {

  }
}