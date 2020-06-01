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
  
  public function update($comment_id, $status, $status_id) {
    $sql = 'update '.$this->dbtable.' set status = "'.$status.'", status_id="'.$status_id.'" where id = :comment_id';
    $exec = $this->dbconn->prepare($sql);
    $exec->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $exec->execute();

    return $exec;
  }

  public function readUpdatedStatus($comment_id) {
    $sql = 'select status, status_id, publicationDate from '.$this->dbtable.' where id = :comment_id';
    $ex = $this->dbconn->prepare($sql);
    $ex->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $ex->execute();

    return $ex;
  }
  
  public function delete($comment_id) {
    $sql = 'delete from '.$this->dbtable.' where id = :comment_id';
    $ex = $this->dbconn->prepare($sql);
    $ex->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $ex->execute();
    
    return $ex;
  }
  
  public function jsonEncodeStatus($comment_id) {
    $statusData = $this->readUpdatedStatus($comment_id);
    extract($statusData->fetch());
    $arr = array(
      'status' => $status,
      'status_id' => $status_id,
      'publicationDate' => $publicationDate
    );
    return(json_encode($arr));
  }
}