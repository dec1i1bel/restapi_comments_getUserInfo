<?php
include '../api/objects/comment.php';

$dbComments = new Db();
$dbCommentsConn = $dbComments->getConnection();

$comment = new Comment($dbCommentsConn);
$comments = $comment->read();
// $commentsCount = comment->count();
$commentsCount = 1;

if($commentsCount>0) {
  $arrComments = array();
  while($row = $comments->fetch()) {
    extract($row);
    $commentSingle = array(
      'message' => $c_message,
      'publicationDate' => $c_publicationDate,
      'status' => $c_status,
      'status_id' => $c_status_id
    );
    array_push($arrComments, $commentSingle);
  }
  $arrComments = json_encode($arrComments);
} else {
  echo json_encode(array('comment' => 'У пользователя нет сообщений'));
}