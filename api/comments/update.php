<?php
include '../api/objects/comment.php';

$arrUpd = json_decode($arrUpd);

if($arrUpd->status_id == 'published') {
  $status_id = 'unpublished';
  $status = 'не опубликовано';
} else {
  $status_id = 'published';
  $status = 'опубликовано';
}

$updAction_dbComments = new Db();
$updAction_dbCommentsConn = $updAction_dbComments->getConnection();

$updAction_comment = new Comment($updAction_dbCommentsConn);

$updAction_updateCommStatus = $updAction_comment->update($arrUpd->comment_id, $status, $status_id);

$updAction_readUpdatedStatus = $updAction_comment->readUpdatedStatus($arrUpd->comment_id);

$statusData = $updAction_readUpdatedStatus->fetch();

extract($statusData);

$arrStatus = array(
  'status' => $status,
  'status_id' => $status_id,
  'publicationDate' => $publicationDate
);
$arrStatus = json_encode($arrStatus);
?>