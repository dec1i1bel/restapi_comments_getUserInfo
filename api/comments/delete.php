<?php
include '../api/objects/comment.php';

$arrRemove = json_decode($arrRemove);
$comment_id = $arrRemove->comment_id;

$remAction_dbComments = new Db();
$remAction_dbCommentsConn = $remAction_dbComments->getConnection();

$remAction_comment = new Comment($remAction_dbCommentsConn);
$remAction_comment->delete($comment_id);
?>