<?php
include '../api/objects/comment.php';

$arrUpd = json_decode($arrUpd);

$updAction_dbComments = new Db();
$updAction_dbCommentsConn = $dbComments->getConnection();

$updAction_comment = new Comment($dbCommentsConn);
$updAction_updateCommStatus = $comment->update($arrUpd['comment_id'], $arrUpd['strStatus_id']);
?>