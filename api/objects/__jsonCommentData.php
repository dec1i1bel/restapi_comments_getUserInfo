<?php
class JsonCommentData extends Base {
  $private dbname = 'comments';
  
  public function getStatusData($comment_id) {
    $sql = 'select status, status_id from comments where id = :comment_id';
    $ex = $this->dbconn->prepare($sql);
    $ex->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $ex->execute;
      
    extract($ex->fetch());
    $statusData = array(
      'status' => $status,
      'status_id' => $status_id
    );
    
    $statusData = json_encode($statusData);
    
    return $statusData;
  }
}
?>